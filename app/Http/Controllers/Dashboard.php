<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }
    public function dashboard()
    {
        return view('/admin/dashboard', ['title' => 'Dashboard', 'active' => 'dashboard']);
    }

    public function user()
    {
        $admin = User::where('role', 'admin')->get();
        $karyawan = Karyawan::all();
        return view('/admin/user_management/user_management', ['title' => 'User Management', 'active' => 'user_management', 'admin' => $admin, 'karyawan' => $karyawan]);
    }

    public function createAdmin(Request $request)
    {

        $validated_data = $request->validate([
            'username' => 'required',
            'id_karyawan' => 'required',
            'email' => 'required|email:dns|unique:users',
            'role' => 'required',
            'password' => 'required'
        ]);

        $validated_data['password'] = Hash::make($validated_data['password']);
        $validated_data['uuid'] = Uuid::uuid4();
        $validated_data['active'] = 'Y';

        $user_firebase = $this->firebaseAuth->createUserWithEmailAndPassword($validated_data['email'], $request->input('password'));
        $user = User::create($validated_data);

        if ($user_firebase && $user) {
            return redirect('/user')->with('success', 'User has been created');
        }
    }
}
