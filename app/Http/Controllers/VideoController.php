




// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Video;
// use Symfony\Component\Process\Process;
// use Illuminate\Support\Facades\Storage;

// class VideoController extends Controller
// {
    // public function store(Request $request)
    // {
        // Pastikan ada nama file untuk video
        // $filename = 'recorded_' . time();

        // Jalankan perintah artisan untuk merekam video menggunakan script Python
        // $process = new Process(['php', 'artisan', 'record:video', $filename]);
        // $process->run();

        // if (!$process->isSuccessful()) {
            // return response()->json(['message' => 'Error: ' . $process->getErrorOutput()], 500);
        // }

        // Path video yang direkam
        // $filePath = 'videos/' . $filename . '.mp4';

        // Simpan path video ke dalam database
        // $newVideo = new Video();
        // $newVideo->title = 'Video ' . now();
        // $newVideo->file_path = $filePath;
        // $newVideo->save();

        // return response()->json(['message' => 'Video recorded and saved successfully!'], 200);
    // }
// 
    // public function destroy(Video $video)
    // {
        // Mengecek apakah file video ada di storage
        // if (Storage::exists('public/' . $video->file_path)) {
            // Menghapus file video dari storage
            // Storage::delete('public/' . $video->file_path);
        // } else {
            // return redirect()->route('videos.index')->with('error', 'File video tidak ditemukan!');
        // }

        // Menghapus data video dari database
        // $video->delete();

        // Redirect dengan pesan sukses
        // return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus!');
    // }
// }
