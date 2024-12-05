<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stimulus;

class StimulusController extends Controller
{
    public function index()
    {
        $stimulus = Stimulus::all();
        return view('admin.daftarstimulus', compact('stimulus'));
    }

    public function create()
    {
        return view('admin.stimulus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:102400',
        ]);

        $file = $request->file('video');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('videos/stimulus', $filename, 'public');

        Stimulus::create([
            'title' => $request->title,
            'path' => $path,
            'is_published' => false,
        ]);

        return redirect()->route('admin.stimulus.index')->with('success', 'Video berhasil diunggah!');
    }

    public function togglePublish(Stimulus $stimulus)
    {
        $stimulus->is_published = !$stimulus->is_published;
        $stimulus->save();

        return back()->with('success', 'Status publikasi berhasil diperbarui!');
    }
}
