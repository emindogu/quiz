<x-app-layout>

    <x-slot name="header">
        {{$quiz->title}} Quizine Ait Sorular
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title float-left">
                <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i>
                    Quizlere Dön
                </a>
            </h5>
            <h5 class="card-title float-right">
                <a href="{{route('questions.create',$quiz->id)}}" class="btn btn-sm btn-primary"><i
                        class="fa fa-plus"></i> Soru Oluştur</a>
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Soru</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">1.Cevap</th>
                        <th scope="col">2.Cevap</th>
                        <th scope="col">3.Cevap</th>
                        <th scope="col">4.Cevap</th>
                        <th scope="col">Doğru Cevap</th>
                        <th scope="col" style="width: 100px">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $question)
                    <tr>
                        <td>{{$question->question}}</td>
                        <td>
                            @if($question->image)
                            <a href="{{asset($question->image)}}" class="btn btn-sm btn-light"
                                target="_blank">Görüntüle</a>
                            @endif
                        </td>
                        <td>{{$question->answer1}}</td>
                        <td>{{$question->answer2}}</td>
                        <td>{{$question->answer3}}</td>
                        <td>{{$question->answer4}}</td>
                        <td class="text-success">{{substr($question->correct_answer,-1)}}</td>
                        <td>
                            <a href="{{route('questions.edit',[$quiz->id, $question->id])}}"
                                class="btn btn-sm btn-primary" title="Soruyu Düzenle"><i class="fa fa-pen"></i></a>
                            <a href="{{route('questions.destroy',[$quiz->id, $question->id])}}"
                                class="btn btn-sm btn-danger" title="Soruyu Sil"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             {!! $questions->render() !!}

           @if($quiz->questions->count()<5)
            <div class="alert alert-warning">
                Soru Sayısı 5'den Azsa Quiz Aktif Edilemez!
            </div>
           @endif

        </div>
    </div>

</x-app-layout>
