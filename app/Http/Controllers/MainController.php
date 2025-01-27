<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;

class MainController extends Controller
{
    public function dashboard()
    {
        $timeOuts = Quiz::whereStatus('publish')->where('finished_at', '<', now())->get();
        foreach ($timeOuts as $timeOut) {
            $timeOut->update(['status' => 'passive']);
        }

        $quizzes = Quiz::where('status', 'publish')->where(function($query){
            $query->whereNull('finished_at')->orWhere('finished_at','>',now());
        })->withCount('questions')->paginate(5);
        $results = auth()->user()->results;
        return view('dashboard', compact('quizzes','results'));
    }

    public function quiz_detail($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('my_result', 'results', 'topTen.user')->withCount('questions')->first() ?? abort(404, 'Quiz Bulunamadı');
        return view('quiz_detail', compact('quiz'));
    }

    public function quiz($slug)
    {
        $quiz = Quiz::whereSlug($slug)->with('questions.my_answer', 'my_result')->first() ?? abort(404, 'Quiz Bulunamadı');

        if ($quiz->my_result) {
            return view('quiz_result', compact('quiz'));
        }

        return view('quiz', compact('quiz'));
    }

    public function result(Request $request, $slug)
    {
        $quiz = Quiz::with('questions')->whereSlug($slug)->first() ?? abort(404, 'Quiz Bulunamadı');
        $correct = 0;

        if ($quiz->my_result) {
            abort(404, "Bu Quiz'e Daha Önce Katıldınız!");
        }

        foreach ($quiz->questions as $question) {
            Answer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $question->id,
                'answer' => $request->post($question->id)
            ]);

            if ($question->correct_answer === $request->post($question->id)) {
                $correct += 1;
            }
        }

        $point = round((100 / count($quiz->questions)) * $correct);
        $wrong = count($quiz->questions) - $correct;

        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => $point,
            'correct' => $correct,
            'wrong' => $wrong
        ]);

        return redirect()->route('quiz.detail', $quiz->slug)->withSuccess("Başarıyla Quiz'i Bitirdin Puanin: " . $point);
    }
}
