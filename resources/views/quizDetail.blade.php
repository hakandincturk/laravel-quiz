<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card">
        <div class="card-body">
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-group">
                            @if($quiz->myRank)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Sıralaman
                                    <span class="badge badge-success badge-pill">#{{$quiz->myRank}}</span>
                                </li>
                            @endif
                            @if($quiz->myResult)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Puan
                                    <span class="badge badge-primary badge-pill">{{$quiz->myResult->point}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Doğru / Yanlış Sayısı
                                    <div class="float-right">
                                        <span class="badge badge-success badge-pill">{{$quiz->myResult->correct}} Doğru</span>
                                        <span class="badge badge-danger badge-pill">{{$quiz->myResult->wrong}} Yanlış</span>

                                    </div>
                                </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Soru Sayısı
                                <span class="badge badge-secondary badge-pill">{{$quiz->questions_count}}</span>
                            </li>
                            @if($quiz->finished_at)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Son Katılım tarihi
                                    <span title="{{$quiz->finished_at}}" class="badge badge-secondary badge-pill">{{$quiz->finished_at->diffForHumans()}}</span>
                                </li>
                            @endif
                            @if($quiz->details)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Katılımcı Sayısı
                                    <span class="badge badge-warning badge-pill">{{$quiz->details['joinedCount']}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Ortalama Puan
                                    <span class="badge badge-light badge-pill">{{$quiz->details['average']}}</span>
                                </li>
                            @endif
                        </ul>
                        @if(count($quiz->topTen) > 0)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h5 class="card-title">En iyi 10</h5>
                                    <ul class="list-group">
                                        @foreach($quiz->topTen as $res)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <strong class="h5">{{$loop->iteration}}.</strong>
                                                    <img class="w-8 h-8 rounded-full mx-2 object-cover" src="{{$res->user->profilePhotoUrl}}">
                                                    <span @if(auth()->user()->id == $res->user->id) class="text-danger" @endif>{{$res->user->name}}</span>
                                                </div>
                                                <span class="badge badge-light badge-pill">{{$res->point}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                <div class="col-md-8">
                        {{$quiz->description}}

                        @if($quiz->myResult)
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-warning btn-block btn-sm mt-2">Quiz'i Görüntüle</a>
                        @elseif($quiz->finished_at > now())
                            <a href="{{route('quiz.join', $quiz->slug)}}" class="btn btn-primary btn-block btn-sm mt-2">Quiz'e Katıl</a>
                        @endif
                    </div>
                </div>
            </p>

        </div>
    </div>
</x-app-layout>
