<?php

use App\Http\Controllers\RekamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\StimulusController;
use App\Http\Controllers\RealSenseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rute Rekaman (Hanya Admin yang Bisa Mengakses)
Route::get('/rekaman', [RekamanController::class, 'index'])
    ->middleware('checkRole:admin') // Hanya admin yang bisa mengakses
    ->name('rekaman.index');

// Rute Sign In untuk User (Hanya User yang Bisa Mengakses)
Route::get('/rekaman/rekam', [RekamanController::class, 'signIn'])
    ->middleware('checkRole:user') // Hanya user yang bisa mengakses
    ->name('rekaman.in');
// Route::get('/rekaman/sementara', [RekamanController::class, 'sementara'])
//     ->middleware('checkRole:admin') // Hanya user yang bisa mengakses
//     ->name('rekaman.sementara');

// Authentication Routes
Auth::routes();

// Rute Home (Hanya Admin yang Bisa Mengakses)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('checkRole:admin') // Hanya admin yang bisa mengakses
    ->name('home');

// Upload Video (Hanya Admin yang Bisa Mengunggah Video)
// Route::post('/upload-video', [VideoController::class, 'store'])
//     ->middleware('checkRole:admin'); // Hanya admin yang bisa mengunggah video
// Route::post('/upload-video', [VideoController::class, 'store'])
//     ->middleware('checkRole:user'); // Hanya admin yang bisa mengunggah video
// Rute Hapus Video (Hanya Admin yang Bisa Menghapus Video)
// Route::delete('/videos/{video}', [VideoController::class, 'destroy'])
//     ->middleware('checkRole:admin') // Hanya admin yang bisa menghapus video
//     ->name('videos.destroy');

// Rute untuk Admin (Dashboard Admin)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('checkRole:admin');

// Rute untuk User (Dashboard User)
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware('checkRole:user');

// Rute Logout (Dari LoginController)
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


//route untuk vidio stimulus
Route::prefix('admin')->group(function () {
    Route::get('/stimulus', [StimulusController::class, 'index'])->name('admin.stimulus.index');
    Route::get('/stimulus/create', [StimulusController::class, 'create'])->name('admin.stimulus.create');
    Route::post('/stimulus', [StimulusController::class, 'store'])->name('admin.stimulus.store');
    Route::patch('/stimulus/{stimulus}/toggle', [StimulusController::class, 'togglePublish'])->name('admin.stimulus.toggle');
});

Route::get('/camera-feed', function () {
    return response()->stream(function () {
        $stream = file_get_contents('http://127.0.0.1:5000/video_feed');
        echo $stream;});
});



// Route::get('/realsense/capture', [RealSenseController::class, 'captureFrame']);
// Route::resource('videos', VideoController::class);
