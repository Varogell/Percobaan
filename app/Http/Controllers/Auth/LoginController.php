<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Mencegah pengguna yang sudah login mengakses halaman login atau register
        $this->middleware('guest')->except('logout');
        // Mengizinkan pengguna yang sudah login untuk logout
        $this->middleware('auth')->only('logout');
    }

    /**
     * After successful authentication, redirect based on user role.
     */
    protected function authenticated(Request $request, $user)
    {
        // Debugging role pengguna (hilangkan setelah memastikan)
        // dd($user->role);

        // Mengarahkan pengguna sesuai dengan role
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
    }

    /**
     * Handle the logout process.
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Menyegarkan session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mengarahkan pengguna kembali ke halaman utama setelah logout
        return redirect('/');
    }
}
