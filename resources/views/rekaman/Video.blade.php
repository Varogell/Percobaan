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
                    <img src="http://127.0.0.1:5000/video_feed" autoplay muted style="width: 100%; height: auto; "></img>





                    <!-- <img src="{{ url('/camera-feed') }}" alt="RealSense Camera Feed"> -->
                        <!-- <video id="cameraVideo" autoplay muted class="p-3 border" style="width: 80%; height: auto;"></video> -->
                    </div>
                </div>
            </div>

            <!-- Card Kedua -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Video Stimulus</span>
                    </div>
                    @foreach ($stimulus as $video)
                    <div class="card-body">
                        <!-- Video stimulus container -->
                        <video id="stimulusVideo" width="100%" height="315" controls>
                            <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                        </video>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-grid my-3">
            <button  id="startRecord" class="btn btn-primary mb-2">Mulai Rekam</button>
            <button  id="stopRecord" class="btn btn-danger">Berhenti Rekam</button>
        </div>
        <p id="status" class="text-center"></p>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        
        const startButton = document.getElementById('startRecord');
        const stopButton = document.getElementById('stopRecord');
        
        startButton.addEventListener('click', () => {
            const stimulusVideo = document.getElementById('stimulusVideo');
            stimulusVideo.play()
            fetch('http://127.0.0.1:5000/start_recording', {method: 'POST'});
        })

        stopButton.addEventListener('click', () => {
            // stimulusVideo.pause()
            fetch('http://127.0.0.1:5000/stop_recording', {method: 'POST'});
        })

        // function startRecording() {
        //     stimulusVideo.play()
        //     fetch('http://127.0.0:5000/start_recording', {method: 'POST'});
        // }

        // function stopRecording() {
        //     stimulusVideo.stop()
        //     fetch('http://127.0.0:5000/stop_recording', {method: 'POST'});
        // }
    })
        
    </script>
<!-- <script>document.addEventListener('DOMContentLoaded', () => {
    const cameraFeed = document.getElementById('camera-feed');
    cameraFeed.src = 'http://127.0.0.1:5000/video_feed';
    cameraFeed.play();

    // const cameraFeed = document.getElementById('camera-feed'); // Streaming feed
    const stimulusVideo = document.getElementById('stimulusVideo'); // Video stimulus
    const startButton = document.getElementById('startRecord');
    const stopButton = document.getElementById('stopRecord');
    const statusElement = document.getElementById('status');

    let mediaRecorder;
    let chunks = [];
    let recording = false;

    // Fungsi untuk menampilkan status
    function setStatus(message, isError = false) {
        statusElement.textContent = message;
        statusElement.style.color = isError ? 'red' : 'green';
    }

    // Membuat canvas untuk menangkap frame dari streaming
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');

    // Fungsi untuk menangkap frame secara periodik
    function captureFrames() {
        if (!recording) return;

        // Set ukuran canvas berdasarkan ukuran video feed
        canvas.width = cameraFeed.width;
        canvas.height = cameraFeed.height;

        // Gambar frame ke canvas
        ctx.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);

        // Lanjutkan menangkap frame setelah 30ms
        setTimeout(captureFrames, 30);
    }

    // Event saat tombol "Mulai Rekam" diklik
    startButton.addEventListener('click', () => {
        if (!cameraFeed.src) {
            setStatus('Camera feed tidak tersedia!', true);
            return;
        }

        // Buat stream dari canvas
        const stream = canvas.captureStream(30); // 30 FPS

        // MediaRecorder untuk merekam stream
        mediaRecorder = new MediaRecorder(stream, { mimeType: 'video/webm' });

        mediaRecorder.ondataavailable = event => {
            chunks.push(event.data);
        };

        mediaRecorder.onstop = () => {
            const blob = new Blob(chunks, { type: 'video/webm' });
            chunks = [];

            // Simpan video sebagai URL
            const videoUrl = URL.createObjectURL(blob);

            // Kirim video ke server
            const formData = new FormData();
            formData.append('video', blob, 'recorded-video.webm');

            setStatus('Mengunggah video...');

            fetch('/upload-video', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData,
            })
                .then(response => {
                    if (response.ok) {
                        setStatus('Video berhasil diunggah!');
                    } else {
                        setStatus('Gagal mengunggah video', true);
                    }
                })
                .catch(error => setStatus('Terjadi kesalahan: ' + error.message, true));

            // Opsional: Tampilkan video di browser setelah selesai merekam
            const previewContainer = document.getElementById('videoPreviewContainer');
            const videoPreview = document.createElement('video');
            videoPreview.controls = true;
            videoPreview.src = videoUrl;
            previewContainer.innerHTML = '';
            previewContainer.appendChild(videoPreview);
        };

        mediaRecorder.start();
        recording = true;
        captureFrames(); // Mulai menangkap frame

        setStatus('Merekam...');
        startButton.disabled = true;
        stopButton.disabled = false;
        stimulusVideo.play(); // Putar video stimulus
    });

    // Event saat tombol "Berhenti Rekam" diklik
    stopButton.addEventListener('click', () => {
        if (mediaRecorder && recording) {
            recording = false;
            mediaRecorder.stop();

            setStatus('Rekaman selesai.');
            startButton.disabled = false;
            stopButton.disabled = true;
            stimulusVideo.pause();
        } else {
            setStatus('MediaRecorder tidak aktif!', true);
        }
    });
});

</script> -->
<!-- @push('js')
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
</script> -->


@endpush
