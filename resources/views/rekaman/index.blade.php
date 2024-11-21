@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Video</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($videos->isEmpty())
            <p>Belum ada video yang direkam.</p>
        @else
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $video->title }}</h5>
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutaran video.
                                </video>
                            </div>
                            <div class="card-footer">
                                <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus Video</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
