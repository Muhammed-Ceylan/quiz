<x-app-layout>
    <x-slot name="header">Quiz Güncelle</x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
                @method('PUT')
                @csrf
                <div class="form-group mt-2">
                    <label for="title">Quiz Başlığı</label>
                    <input type="text" name="title" class="form-control" value="{{ $quiz->title }}">
                </div>
                <div class="form-group mt-2">
                    <label for="description">Quiz Açıklama</label>
                    <textarea name="description" class="form-control" rows="4">{{ $quiz->description }}</textarea>
                </div>
                <div class="form-group mt-2">
                    <input type="checkbox" id="isFinished">
                    <label>Bitiş Tarihi Olacak Mı?</label>
                </div>
                <div class="form-group mt-2">
                    <label for="finished_at">Quiz Bitiş Tarihi</label>
                    <input type="datetime-local" name="finished_at" class="form-control"
                        value="{{ $quiz->finished_at }}">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-success btn-sm btn-block form-control">Quiz Güncelle</button>
                </div>
            </form>
        </div>
    </div>
    {{-- <x-slot name="checkbox">
        <script>
            jquery('#isFinished').change(function() {
                if (jquery('#isFinished').is(':checked')) {
                    jquery('#finishedInput').show();
                } else {
                    jquery('#finishedInput').hide();
                }
            })
        </script>
    </x-slot> --}}
</x-app-layout>
