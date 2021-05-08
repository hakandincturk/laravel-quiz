<x-app-layout>
    <x-slot name="header">{{$quiz->title}}</x-slot>
    <div class="card">
        <div class="card-body">
            <p class="card-text">
            <a href="{{route('quizzes.index')}}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Quizlere Dön</a>
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
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

                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ad Soyad</th>
                            <th scope="col">Aldığı Puan</th>
                            <th scope="col">Doğru</th>
                            <th scope="col">Yanlış</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($quiz->results as $result)
                            <tr>
                                <th scope="row">{{$result->id}}</th>
                                <td>{{$result->user->name}}</td>
                                <td>{{$result->point}}</td>
                                <td>{{$result->correct}}</td>
                                <td>{{$result->wrong}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </p>

        </div>
    </div>
</x-app-layout>
