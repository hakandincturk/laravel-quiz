<x-app-layout>
    <x-slot name="header">{{$question->question}} Duzenle.</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('questions.update', [$question->quizId, $question->id])}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Soru</label>
                    <textarea type="text" name="question" class="form-control">{{$question->question}}</textarea>
                </div>

                <div class="form-group">
                    <label>Fotoğraf</label>
                    @if($question->image)
                        <a href="{{asset($question->image)}}" target="_blank">
                            <img src="{{asset($question->image)}}" style="width: 200px;">
                        </a>
                    @endif
                    <input type="file" name="image" class="form-control" rows="4"/>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>1. Cevap</label>
                            <textarea type="text" name="answer1" class="form-control">{{$question->answer1}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>2. Cevap</label>
                            <textarea type="text" name="answer2" class="form-control">{{$question->answer2}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>3. Cevap</label>
                            <textarea type="text" name="answer3" class="form-control">{{$question->answer3}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>2. Cevap</label>
                            <textarea type="text" name="answer4" class="form-control" >{{$question->answer4}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Doğru Cevap</label>
                    <select name="correctAnswer" class="form-control">
                        <option @if($question->correctAnswer === 'answer1') selected @endif value="answer1">1. Cevap</option>
                        <option @if($question->correctAnswer === 'answer2') selected @endif value="answer2">2. Cevap</option>
                        <option @if($question->correctAnswer === 'answer3') selected @endif value="answer3">3. Cevap</option>
                        <option @if($question->correctAnswer === 'answer4') selected @endif value="answer4">4. Cevap</option>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block" type="submit">Soru Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
