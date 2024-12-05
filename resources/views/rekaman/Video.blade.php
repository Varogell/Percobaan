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
                        <video id="cameraVideo" autoplay muted class="p-3 border" style="width: 80%; height: auto;"></video>
                    </div>
                </div>
            </div>

            <!-- Card Kedua -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Video Stimulus</span>
                    </div>
                    <div class="card-body">
                        <!-- Video stimulus container -->
                        <video id="stimulusVideo" width="100%" height="315" controls>
                            <source src="/stimulus/kucing.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid my-3">
            <button id="startRecord" class="btn btn-primary mb-2">Mulai Rekam</button>
            <button id="stopRecord" class="btn btn-danger" disabled>Berhenti Rekam</button>
        </div>
        <p id="status" class="text-center"></p>
    </div>
@endsection

@push('js')
<script>
    const cameraVideo = document.getElementById('cameraVideo'); // Video dari kamera
    const stimulusVideo = document.getElementById('stimulusVideo'); // Video stimulus
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

    // Meminta akses kamera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            cameraVideo.srcObject = stream;
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = event => {
                chunks.push(event.data);
            };

            mediaRecorder.onstop = () => {
                const blob = new Blob(chunks, { type: 'video/webm' });
                chunks = [];

                // Simpan video di URL objek (agar bisa diputar)
                const videoUrl = URL.createObjectURL(blob);

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

                // Opsional: Jika ingin menampilkan video yang sudah direkam di browser
                const previewContainer = document.getElementById('videoPreviewContainer');
                const videoPreview = document.createElement('video');
                videoPreview.controls = true;
                videoPreview.src = videoUrl;  // URL yang mengarah ke Blob
                previewContainer.innerHTML = '';  // Kosongkan container preview
                previewContainer.appendChild(videoPreview);  // Tambahkan video preview
            };
        })
        .catch(error => setStatus('Gagal mengakses kamera: ' + error.message, true));

    // Event saat tombol "Mulai Rekam" diklik
    startButton.addEventListener('click', () => {
        // Mulai rekam video
        mediaRecorder.start();
        setStatus('Merekam...');
        cameraVideo.play();
        
        // Putar video stimulus dan reset waktu ke awal
        stimulusVideo.currentTime = 0;
        stimulusVideo.play();
        
        startButton.disabled = true;
        stopButton.disabled = false;
    });

    // Event saat tombol "Berhenti Rekam" diklik
    stopButton.addEventListener('click', () => {
        mediaRecorder.stop();
        setStatus('Rekaman selesai.');
        cameraVideo.pause();
        stimulusVideo.pause(); // Hentikan video stimulus
        startButton.disabled = false;
        stopButton.disabled = true;
    });

    // Jam real-time
    setInterval(() => {
        const d = new Date();
        document.getElementById("clock").textContent = d.toLocaleTimeString();
    }, 1000);
</script>
@endpush
