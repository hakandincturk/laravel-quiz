<x-app-layout>
    <x-slot name="header">Quiz Oluştur</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('quizzes.store')}}">
                @csrf
                <div class="form-group">
                    <label>Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div>

                <div class="form-group">
                    <label>Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows="4">{{old('description')}}</textarea>
                </div>

                <div class="form-group">
                    <input id="isFinished" type="checkbox" @if(old('finished_at')) checked @endif style="cursor: pointer;"1>
                    <label for="isFinished" style="cursor: pointer;">Bitiş Tarihi Olacak Mı?</label>
                </div>

                <div id="finishedInput" @if(!old('finished_at')) style="display: none;" @endif class="form-group">
                    <label>Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control" value="{{old('finished_at')}}">
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-sm btn-block" type="submit">Quiz Oluştur</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="js">
        <script>
            $('#isFinished').change(function(){
                if ($('#isFinished').is(':checked')) {
                    $('#finishedInput').show();
                }else{
                    $('#finishedInput').hide();
                }
            });
        </script>
    </x-slot>
</x-app-layout>