<!-- <head>
    <!-- Head Elements lainnya -->
    <link rel="stylesheet" href="{{ asset('css/vidio.css') }}">
</head>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Card Pertama -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Record</span>
                        <span id="clock"></span>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <video id="video" autoplay class="p-3 border" style="width: 80%; height: auto;"></video>
                    </div>
                </div>
            </div>

            <!-- Card Kedua -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Video Preview</span>
                    </div>
                    <div class="card-body">
                        <!-- Video preview container -->
                        <div id="videoPreviewContainer">
                            <span id="status">Preview akan muncul setelah video direkam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid my-3">
            <button id="startRecord" class="btn btn-primary mb-2">Mulai Rekam</button>
            <button id="stopRecord" class="btn btn-danger" disabled>Berhenti Rekam</button>
        </div>
    </div>
@endsection

@push('js')
<script>
    const video = document.getElementById('video');
    const startButton = document.getElementById('startRecord');
    const stopButton = document.getElementById('stopRecord');
    const statusElement = document.getElementById('status');
    let mediaRecorder;
    let chunks = [];

    // Fungsi untuk menampilkan status
    function setStatus(message, isError = false) {
        statusElement.textContent = message;
        statusElement.style.color = isError ? 'red' : 'green';
    }

    // Meminta akses kamera dan mikrofon
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = event => {
                chunks.push(event.data);
            };

            mediaRecorder.onstop = () => {
                const blob = new Blob(chunks, { type: 'video/webm' });
                chunks = [];

                // Buat URL objek dari Blob video
                const videoUrl = URL.createObjectURL(blob);

                // Update status
                setStatus('Rekaman selesai. Menampilkan preview...');

                // Tampilkan video yang direkam di preview
                const previewContainer = document.getElementById('videoPreviewContainer');
                previewContainer.innerHTML = ''; // Clear previous content

                const videoPreview = document.createElement('video');
                videoPreview.controls = true;
                videoPreview.style.width = "100%";
                videoPreview.style.height = "auto";
                videoPreview.src = videoUrl;  // Set video source

                previewContainer.appendChild(videoPreview); // Add video element to the preview

                // Kirim video ke server
                const formData = new FormData();
                formData.append('video', blob, 'recorded-video.webm');
                
                setStatus('Mengunggah video...');

                // Mengirim video ke server dengan fetch
                fetch('/upload-video', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF Laravel
                    },
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        setStatus('Video berhasil diunggah!');
                    } else {
                        setStatus('Gagal mengunggah video', true);
                    }
                })
                .catch(error => setStatus('Terjadi kesalahan: ' + error.message, true));
            };
        })
        .catch(error => setStatus('Gagal mengakses kamera: ' + error.message, true));

    // Event saat tombol "Mulai Rekam" diklik
    startButton.addEventListener('click', () => {
        mediaRecorder.start();
        setStatus('Merekam...');
        startButton.disabled = true;
        stopButton.disabled = false;
    });

    // Event saat tombol "Berhenti Rekam" diklik
    stopButton.addEventListener('click', () => {
        mediaRecorder.stop();
        setStatus('Rekaman selesai.');
        startButton.disabled = false;
        stopButton.disabled = true;
    });

    // Jam real-time
    setInterval(() => {
        const d = new Date();
        document.getElementById("clock").textContent = d.toLocaleTimeString();
    }, 1000);
</script>
@endpush -->
