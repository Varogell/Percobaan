@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Daftar Video Stimulus</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stimulus as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>
                        <span class="badge {{ $video->is_published ? 'badge-success' : 'badge-secondary' }}">
                            {{ $video->is_published ? 'Dipublikasikan' : 'Tidak Dipublikasikan' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.stimulus.toggle', $video->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $video->is_published ? 'btn-warning' : 'btn-primary' }}">
                                {{ $video->is_published ? 'Sembunyikan' : 'Tampilkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
 