<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login_register.login');
    }

    public function authenticate(Request $request)
    {

        $credential = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:5',
        ]);

        $user = User::where('email', $credential['email'])
            ->get();

        if (Auth::attempt($credential)) {
            if ($user[0]->role == 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/admin-dashboard/lowongan');
            } elseif ($user[0]->role == 'user') {
                $request->session()->regenerate();
                return redirect()->intended('/lowongan-kerja');
            }
        }

        return back()->with('loginError', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {

        if ($request->id_karyawan != null) {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');

        } else if ($request->id_pelamar != null) {
            
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/lowongan-kerja');
        }
    }
}
