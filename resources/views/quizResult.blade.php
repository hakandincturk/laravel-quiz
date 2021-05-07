<x-app-layout>
    <x-slot name="header">{{$quiz->title}} Sonucu</x-slot>
    <div class="card">
        <div class="card-body">

            <div class="alert bg-light">
                Eğer doğru şıkkı işaretlediysen sadece yeşil ile yazılır.<br>
                <span class="text-success font-weight-bold">Doğru olan şıklar bu şekilde görünür.</span><br>
                <span class="text-danger font-weight-bold">Senin işaretlediğin ve yanlış olan şıklar bu şekilde görünür.</span>
            </div>

            <form action="{{route('quiz.result', $quiz->slug)}}">
                @csrf
                @foreach($quiz->questions as $question)
                    @if($question->correctAnswer == $question->myAnswer->answer)
                        <i class="fa fa-check text-success"></i>
                    @else
                        <i class="fa fa-times text-danger"></i>
                    @endif
                    <strong>#{{$loop->iteration}}</strong> {{$question->question}}
                    @if($question->image) <img src="{{asset($question->image)}}" style="width: 50%;" /> @endif

                    <div class="form-check mt-2">

                        <label class="form-check-label
                                @if('answer1' == $question->correctAnswer)
                                    text-success font-weight-bold
                                @elseif('answer1' == $question->myAnswer->answer)
                                    text-danger font-weight-bold
                                @endif" for="quiz{{$question->id}}1">
                            {{$question->answer1}}
                        </label>
                    </div>
                    <div class="form-check">

                        <label class="form-check-label
                                @if('answer2' == $question->correctAnswer)
                                    text-success font-weight-bold
                                @elseif('answer2' == $question->myAnswer->answer)
                                    text-danger font-weight-bold
                                @endif" for="quiz{{$question->id}}2">
                            {{$question->answer2}}
                        </label>
                    </div>
                    <div class="form-check">

                        <label class="form-check-label
                                @if('answer3' == $question->correctAnswer)
                                    text-success font-weight-bold
                                @elseif('answer3' == $question->myAnswer->answer)
                                    text-danger font-weight-bold
                                @endif" for="quiz{{$question->id}}3">
                            {{$question->answer3}}
                        </label>
                    </div>
                    <div class="form-check">

                        <label class="form-check-label
                                @if('answer4' == $question->correctAnswer)
                                    text-success font-weight-bold
                                @elseif('answer4' == $question->myAnswer->answer)
                                    text-danger font-weight-bold
                                @endif" for="quiz{{$question->id}}4">
                            {{$question->answer4}}
                        </label>
                    </div>
                    @if(!$loop->last) <hr> @endif
                @endforeach
            </form>
        </div>
    </div>
</x-app-layout>
