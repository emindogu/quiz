<x-app-layout>
    <x-slot name="header">
        Quiz Düzenle
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('quizzes.update',$quiz->id)}}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control mt-2" value="{{$quiz->title}}">
                </div>
                <div class="form-group">
                    <label for="" class="mt-4">Quiz Konusu</label>
                    <textarea name="description" class="form-control mt-2" id=""
                        rows="4">{{$quiz->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="" class="mt-4">Quiz Durumu</label>
                    <select name="status" class="form-control">
                        <option @if($quiz->questions_count<5) disabled @endif @if($quiz->status==='publish') selected @endif value="publish">Aktif</option>
                        <option @if($quiz->status==='passive') selected @endif value="passive">Pasif</option>
                        <option @if($quiz->status==='draft') selected @endif value="draft">Taslak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class=" mt-4"><input id="isFinished" type="checkbox" @if($quiz->finished_at) checked @endif>
                        Bitiş Tarihi Olacak
                        mı?</label>
                </div>
                <div id="finishedInput" class="form-group" @if(!$quiz->finished_at) style="display:none" @endif>
                    <label for="" class="mt-4">Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control mt-2 tarih"
                        @if($quiz->finished_at) value="{{date('Y-m-d\TH:i', strtotime($quiz->finished_at))}}" @endif>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block mt-4 form-control">Quiz
                        Güncelle</button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="js">
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            $('#isFinished').change(function () {
                if ($('#isFinished').is(':checked')) {
                    $('#finishedInput').show();
                } else {
                    $('#finishedInput').hide();
                    $('.tarih').val(null);
                }
            })

        </script>
    </x-slot>

</x-app-layout>
