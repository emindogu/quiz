<x-app-layout>
    <x-slot name="header">
        {{$question->question}} Düzenle
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('questions.update',[$question->quiz_id,$question->id])}}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Soru</label>
                    <textarea name="question" class="form-control mt-2" id=""
                        rows="4">{{$question->question}}</textarea>
                </div>
                <div class="form-group">
                    <label for="" class="mt-4">Fotoğraf</label>
                    @if($question->image)
                    <a href="{{asset($question->image)}}" target="_blank"></a>
                    <img src="{{asset($question->image)}}" class="img-responsive" style="width:200px">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label for="">1.Cevap</label>
                            <textarea name="answer1" class="form-control mt-2" id=""
                                rows="2">{{$question->answer1}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label for="">2.Cevap</label>
                            <textarea name="answer2" class="form-control mt-2" id=""
                                rows="2">{{$question->answer2}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label for="">3.Cevap</label>
                            <textarea name="answer3" class="form-control mt-2" id=""
                                rows="2">{{$question->answer3}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="form-group">
                            <label for="">4.Cevap</label>
                            <textarea name="answer4" class="form-control mt-2" id=""
                                rows="2">{{$question->answer4}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="mt-4">Doğru Cevap</label>
                    <select name="correct_answer" class="form-control">
                        <option @if($question->correct_answer==='answer1') selected @endif value="answer1">1.Cevap
                        </option>
                        <option @if($question->correct_answer==='answer2') selected @endif value="answer2">2.Cevap
                        </option>
                        <option @if($question->correct_answer==='answer3') selected @endif value="answer3">3.Cevap
                        </option>
                        <option @if($question->correct_answer==='answer4') selected @endif value="answer4">4.Cevap
                        </option>
                    </select>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block mt-4 form-control">Soruyu
                        Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
