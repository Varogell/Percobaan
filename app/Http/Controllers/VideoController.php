<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function store(Request $request)
    {
        // Validasi video
        $request->validate([
            'video' => 'required|file|mimes:mp4,webm,avi,mov|max:512000', // Maksimal 500MB
        ]);

        if ($request->hasFile('video')) {
            // Mendapatkan file video yang diupload
            $video = $request->file('video');
            
            // Menyimpan video ke dalam storage publik
            $videoPath = $video->store('videos', 'public');

            // Simpan path video ke dalam database
            $newVideo = new Video();
            $newVideo->path = $videoPath;
            $newVideo->save();

            return response()->json(['message' => 'Video uploaded successfully'], 200);
        }

        return response()->json(['message' => 'No video file found'], 400);
    }
    public function destroy(Video $video)
    {
    // Mengecek apakah file video ada di storage
    if (Storage::exists('public/' . $video->path)) {
        // Menghapus file video dari storage
        Storage::delete('public/' . $video->path);
    } else {
        // Jika file video tidak ditemukan
        return redirect()->route('rekaman.index')->with('error', 'File video tidak ditemukan!');
    }

    // Menghapus data video dari database
    $video->delete();

    // Redirect dengan pesan sukses
    return redirect()->route('rekaman.index')->with('success', 'Video berhasil dihapus!');
    }

}
