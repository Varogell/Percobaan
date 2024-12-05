<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video; // Pastikan model Video sudah dibuat

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
        return view('rekaman.Video');
    }
    // public function Sementara()
    // {
    //     return view('rekaman.sementara');
    // }
}
