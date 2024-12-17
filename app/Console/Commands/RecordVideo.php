<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;

class RecordVideo extends Command
{
    protected $signature = 'record:video {filename}';
    protected $description = 'Record a video using Intel RealSense Camera';

    public function handle()
{
    $filename = $this->argument('filename');
    $outputPath = storage_path('app/videos/' . $filename . '.mp4');

    // Pastikan folder videos ada, jika tidak buat folder
    if (!file_exists(storage_path('app/videos'))) {
        mkdir(storage_path('app/videos'), 0777, true);
    }

    // Jalankan script Python
    $process = new Process(['python', base_path('scripts/record_video.py'), $outputPath]);
    $process->setTimeout(3600); // Maksimal 1 jam
    $process->run();

    if (!$process->isSuccessful()) {
        $this->error('Error: ' . $process->getErrorOutput());
    } else {
        $this->info('Video recorded successfully at: ' . $outputPath);
    }
}

}
