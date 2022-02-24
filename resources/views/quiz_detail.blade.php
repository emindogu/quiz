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
                            @if ($quiz->my_rank)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sıralama
                                <span class="badge bg-dark bg-pill" style="font-weight:bold">{{$quiz->my_rank}}</span>
                            </li> 
                            @endif
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

                        @if (count($quiz->topTen)>0)
                        <div class="card mt-3">
                            <div class="card-body">
                                <p class="card-title" style="font-size: 16px"><strong>Top 10</strong>
                                    <ul class="list-group">
                                        @foreach ($quiz->topTen as $row)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <strong>{{$loop->iteration}})</strong>
                                            <img class="w-8 h-8 rounded-full" src="{{$row->user->profile_photo_url}}">
                                            <span @if (auth()->user()->id==$row->user_id) class="text-danger" @endif>{{$row->user->name}}</span>
                                            <span class="badge bg-dark bg-pill">{{$row->point}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </p>
                            </div>
                        </div>    
                        @endif
                        

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
