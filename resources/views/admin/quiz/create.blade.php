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
                   <label class="checkbox-inline mt-4"><input type="checkbox"> Bitiş Tarihi Olacak mı?</label>
                </div>
                <div class="form-group">
                    <label for="" class="mt-4">Bitiş Tarihi</label>
                   <input type="datetime-local" name="finished_at" class="form-control mt-2">
                </div>
                    <div class="form-group">
                  <button type="submit" class="btn btn-success btn-sm btn-block mt-4 form-control">Quiz Oluştur</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>