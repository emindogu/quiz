<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @if($quiz->my_result)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Puan
                                <span class="badge bg-success bg-pill">{{$quiz->my_result->point}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Doğru / Yanlış Sayıları
                                <div class="float-rigt">
                                    <span class="badge bg-warning bg-pill">{{$quiz->my_result->correct}} Doğru</span>
                                    <span class="badge bg-danger bg-pill">{{$quiz->my_result->wrong}} Yanlış</span>
                                </div>
                            </li>
                            @endif
                            @if($quiz->finished_at)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Son Katılım Tarihi
                                <span title="{{$quiz->finished_at}}"
                                    class="badge bg-primary bg-pill">{{$quiz->finished_at->diffForHumans()}}</span>
                            </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge bg-info bg-pill">{{$quiz->questions_count}}</span>
                            </li>
                            @if($quiz->details)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Katılımcı Sayısı
                                <span class="badge bg-secondary bg-pill">{{$quiz->details['join_count']}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ortalama Puan
                                <span class="badge bg-primary bg-pill">{{$quiz->details['average']}}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-8" style="position: relative">
                        <div style="position: absolute; top: 0;">
                            {{$quiz->description}}
                        </div>
                        <div style="position: absolute; bottom: 0;">
                            @if($quiz->my_result)
                            <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-warning">Quiz'i Görüntüle</a>
                            @else
                            <a href="{{route('quiz.join',$quiz->slug)}}" class="btn btn-primary">Quiz'e Katıl</a>
                            @endif
                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>

</x-app-layout>
