<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;//ben ekledim

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $quiz = Quiz::whereId($id)->with('questions')->first() ?? abort(404, 'Quiz Bulunamadı');

        if (request()->get('ara')) {         
        //    $quiz = Quiz::whereId($id)->with('questions')->where('questions.question', 'LIKE', '%' . request()->get('question') . '%')->get();
        //    $quiz=Quiz::whereId($id)->with(['question' => function ($join) {
        //        $join->where('question', 'LIKE', '%' . request()->get('question') . '%')->get();
        //    }]);
        $data= Quiz::where('quizzes.id',$id)->join('questions','questions.quiz_id','=', 'quizzes.id')->where('questions.question', 'LIKE', '%' . request()->get('ara') . '%')
                    ->get(['questions.question', 'questions.image', 'questions.answer1', 'questions.answer2', 'questions.answer3', 'questions.answer4', 'questions.correct_answer']);
            //$data=$data->paginate(5);
            //return dd($questions);
        }
        else {
            $data=null;
        }

        $questions = $quiz->questions()->paginate(5);
        return view('admin.question.list',compact('quiz','questions','data')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request, $id)
    {
        if ($request->hasFile('image')) {
            $fileName = Str::slug($request->question) .'.'. $request->image->extension();
            $fileNameWithUpload = 'uploads/'.$fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge(['image'=>$fileNameWithUpload]);
        }

        Quiz::find($id)->questions()->create($request->post());

        return redirect()->route('questions.index',$id)->withSuccess('Soru Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id, $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Quiz veya Soru Bulunamadı');
        return view('admin.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {
        if ($request->hasFile('image')) {
            File::delete(public_path($request->image));//ben ekledim 
            $fileName = Str::slug($request->question) . '.' . $request->image->extension();
            $fileNameWithUpload = 'uploads/' . $fileName;
            $request->image->move(public_path('uploads'), $fileName);
            $request->merge(['image' => $fileNameWithUpload]);
        }

        Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post());

        return redirect()->route('questions.index', $quiz_id)->withSuccess('Soru Başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($quiz_id, $question_id)
    {
       Quiz::find($quiz_id)->questions()->whereId($question_id)->delete();
       return redirect()->route('questions.index',$quiz_id)->withSuccess('Soru Başarıyla Silindi');
    }
}
