<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}} Quiz Sonucu
    </x-slot>

    <div class="card">
        <div class="card-body">

            <h5 class="alert alert-success">Puan: <strong>{{$quiz->my_result->point}}</strong></h5>

            @foreach ($quiz->questions as $question)

            @if ($question->correct_answer==$question->my_answer->answer)
            <i class="fa fa-check text-success"></i>
            @else
            <i class="fa fa-times text-danger"></i>
            @endif

            <strong>{{$loop->iteration}})</strong> {{$question->question}} <span class="badge bg-success bg-pill">Doğru
                Yanıtlama %{{$question->true_percent}}</span>

            @if ($question->image)
            <img src="{{asset($question->image)}}" style="width:200px" alt="" class="img-responsive">
            @endif

            <div class="form-check">
                @if('answer1' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer1'==$question->my_answer->answer)
                <i class="fa fa-arrow-right text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}1">
                    {{$question->answer1}}
                </label>
            </div>

            <div class="form-check">
                @if('answer2' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer2'==$question->my_answer->answer)
                <i class="fa fa-arrow-right text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}2">
                    {{$question->answer2}}
                </label>
            </div>

            <div class="form-check">
                @if('answer3' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer3'==$question->my_answer->answer)
                <i class="fa fa-arrow-right text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}3">
                    {{$question->answer3}}
                </label>
            </div>

            <div class="form-check">
                @if('answer4' == $question->correct_answer)
                <i class="fa fa-check text-success"></i>
                @elseif('answer4'==$question->my_answer->answer)
                <i class="fa fa-arrow-right text-danger"></i>
                @endif
                <label class="form-check-label" for="quiz{{$question->id}}4">
                    {{$question->answer4}}
                </label>
            </div>

            @if (!$loop->last)
            <hr>
            @endif

            @endforeach

        </div>
    </div>

</x-app-layout>
