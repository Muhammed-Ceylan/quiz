<x-app-layout>
    <x-slot name="header">Quizler</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary"> Quiz Oluştur</a>
            </h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quiz</th>
                        <th scope="col">Soru Sayısı</th>
                        <th scope="col">Durum</th>
                        <th scope="col">Bitiş Tarihi</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->questions_count }}</td>
                            <td>
                                @switch($quiz->status)
                                    @case('publish')
                                        <span class="badge rounded-pill text-bg-success">Aktif</span>
                                    @break

                                    @case('passive')
                                        <span class="badge rounded-pill text-bg-danger">Aktif</span>
                                    @break

                                    @case('draft')
                                        <span class="badge rounded-pill text-bg-warning">Taslak</span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                <span title="{{ $quiz->finished_at }}">
                                    {{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                    class="btn btn-sm btn-primary">Düzenle</a>
                                <a href="{{ route('quizzes.destroy', $quiz->id) }}"
                                    class="btn btn-sm btn-danger">Sil</a>
                                <a href="{{ route('questions.index', $quiz->id) }}"
                                    class="btn btn-sm btn-warning">Sorular Gör</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $quizzes->links() }}
        </div>
    </div>
</x-app-layout>
