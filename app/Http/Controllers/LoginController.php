<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class LoginController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }

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

        try {

            $signInResult = $this->firebaseAuth->signInWithEmailAndPassword($credential['email'], $credential['password']);

            if ($signInResult && Auth::attempt($credential)) {
                if ($user[0]->role == 'admin') {
                    $request->session()->regenerate();
                    return redirect()->intended('/admin-dashboard/lowongan');
                } elseif ($user[0]->role == 'user') {
                    $request->session()->regenerate();
                    return redirect()->intended('/lowongan-kerja');
                }
            } elseif ($signInResult == null && Auth::attempt($credential)) {
                if ($user[0]->role == 'admin') {
                    $request->session()->regenerate();
                    return redirect()->intended('/admin-dashboard/lowongan');
                } elseif ($user[0]->role == 'user') {
                    $request->session()->regenerate();
                    return redirect()->intended('/lowongan-kerja');
                }
            }
            // Authentication successful, handle further actions
        } catch (\Kreait\Firebase\Exception\Auth\InvalidPassword $e) {
            // Handle invalid password error
            return response()->json(['error' => 'INVALID_PASSWORD'], 401);
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            // Handle user not found error
            return response()->json(['error' => 'USER_NOT_FOUND'], 404);
        } catch (\Exception $e) {
            // Handle other authentication errors
            return response()->json(['error' => 'AUTHENTICATION_ERROR'], 500);
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
