<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p class="card-text">
                <h5 class="card-title">
                    <a href="{{route('quizzes.index')}}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i>
                        Quizlere Dön
                    </a>
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
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
                                            <span>{{$row->user->name}}</span>
                                            <span class="badge bg-dark bg-pill">{{$row->point}}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div>
                            {{$quiz->description}}

                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">Ad Soyad</th>
                                        <th scope="col">Puan</th>
                                        <th scope="col">Doğru</th>
                                        <th scope="col">Yanlış</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quiz->results as $row)
                                    <tr>
                                        <td>{{$row->user->name}}</td>
                                        <td>{{$row->point}}</td>
                                        <td>{{$row->correct}}</td>
                                        <td>{{$row->wrong}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </p>
        </div>
    </div>

</x-app-layout>
