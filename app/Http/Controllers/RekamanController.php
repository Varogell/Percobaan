<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video; // Pastikan model Video sudah dibuat
use App\Models\Stimulus;

class RekamanController extends Controller
{
    // Menampilkan semua video
    public function index()
    {
        // Ambil semua video dari database
        $videos = Video::all();

        // Kirim data ke view
        return view('rekaman.index', compact('videos'));
    }

    // Menampilkan halaman untuk merekam video baru
    public function signIn()
    {

         // Ambil semua video yang dipublikasikan
         $stimulus = Stimulus::where('is_published', true)->get();

  
        if ($stimulus) {
            // Kirimkan elemen tunggal ke view
            return view('rekaman.Video', compact('stimulus'));
        } else {
            return view('rekaman.Video')->with('error', 'Tidak ada video yang dipublikasikan.');
        }

        // return view('rekaman.Video',compact('stimulus'));
    }
    // public function Sementara()
    // {
    //     return view('rekaman.sementara');
    // }
}
