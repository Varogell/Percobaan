@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Unggah Video Stimulus</div>

                <div class="card-body">
                    <form action="{{ route('admin.stimulus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Judul Video</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>

                        <div class="form-group">
                            <label for="video">Pilih Video</label>
                            <input type="file" class="form-control-file" name="video" id="video" accept="video/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Unggah</button>
                    </form>

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
