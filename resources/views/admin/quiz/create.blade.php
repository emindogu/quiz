<x-app-layout>
    <x-slot name="header">
        Quiz Oluştur
    </x-slot>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('quizzes.store')}}">
                @csrf
                <div class="form-group">
                    <label for="">Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control mt-2" required>
                </div>
                <div class="form-group">
                    <label for="" class="mt-4">Quiz Konusu</label>
                    <textarea name="description" class="form-control mt-2" id="" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label class=" mt-4"><input id="isFinished" type="checkbox">  Bitiş Tarihi Olacak
                        mı?</label>
                </div>
                <div id="finishedInput" class="form-group" style="display:none">
                    <label for="" class="mt-4">Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block mt-4 form-control">Quiz
                        Oluştur</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="js">
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            $('#isFinished').change(function() {
                if($('#isFinished').is(':checked')) {
                    $('#finishedInput').show();
                } else {
                    $('#finishedInput').hide();
                }
            })
        </script>
    </x-slot>

</x-app-layout>
