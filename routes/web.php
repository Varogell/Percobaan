<?php
use App\Http\Controllers\RekamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

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

Route::get('/rekaman',[RekamanController::class,'index'])->name('rekaman.index');
Route::get('/rekaman/sign_in',[RekamanController::class,'signIn'])->name('rekaman.in');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/upload-video', [VideoController::class, 'store']);
Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
