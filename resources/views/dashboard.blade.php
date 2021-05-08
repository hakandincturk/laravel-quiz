<x-app-layout>
    <x-slot name="header">Ana Sayfa</x-slot>
    <div class="row">
        <div class="col-md-8">
            <div class="list-group">
                @foreach($quizzes as $quiz)
                    <a href="{{route('quiz.detail', $quiz->slug)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{$quiz->title}}</h5>
                            <small>{{$quiz->finished_at ? $quiz->finished_at->diffForHumans() .' bitiyor ':null}}</small>
                        </div>
                        <p class="mb-1">{{Str::limit($quiz->description, 100)}}</p>
                        <small>{{$quiz->questions_count}} soru</small>
                    </a>
                @endforeach

                <div class="mt-2">{{$quizzes->links()}}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Quiz Sonuçları
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($userResults as $userResult)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{route('quiz.detail', $userResult->quiz->slug)}}">{{$userResult->quiz->title}}</a>
                            <span class="badge badge-light badge-pill">{{$userResult->point}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
