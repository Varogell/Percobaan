<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RealSenseController extends Controller
{
    public function captureFrame()
    {
        $response = Http::get('http://localhost:5000/realsense/capture');

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to capture frame'], 500);}
        
}
