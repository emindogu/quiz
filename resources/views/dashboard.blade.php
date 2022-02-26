<x-app-layout>
    <x-slot name="header">
        Anasayfa
    </x-slot>

    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach ($quizzes as $quiz)
                <a href="{{route('quiz.detail',$quiz->slug)}}" class="list-group-item list-group-item-action"
                    aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><b>{{$quiz->title}}</b></h5>
                        <small
                            style="color:firebrick">{{$quiz->finished_at ? $quiz->finished_at->diffForHumans().' bitiyor.' : null}}</small>
                    </div>
                    <p class="mb-1">{{Str::limit($quiz->description,100)}}</p>
                    <small style="color:blue">{{$quiz->questions_count}} Soru</small>
                </a>
                @endforeach
                {{$quizzes->links()}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Quiz Sonuçları
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($results as $row)
                    <li class="list-group-item">{{$loop->iteration}}) 
                        <a href="{{route('quiz.detail',$row->quiz->slug)}}">{{$row->quiz->title}}</a> <span
                            class="text-secondary">(Puan:{{$row->point}})</span> </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-app-layout>
