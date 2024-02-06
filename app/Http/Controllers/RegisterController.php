<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelamar;
use App\Models\UserRole;
use App\Notifications\RegisterMessage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    public function index()
    {
        return view("login_register.register");
    }

    public function store(Request $request)
    {
        $validated_data_pelamar = $request->validate([
            'nama_pelamar' => 'required|max:255',
            'email' => 'required|email:dns|unique:pelamar',
        ]);

        $data_notifikasi = [
            'nama_pelamar' => $request->nama_pelamar
        ];

        $validated_data_user = $request->validate([
            'username' => 'required|max:255',
            'slug' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255|confirmed',

        ]);

        $validated_data_user['password'] = Hash::make($validated_data_user['password']);
        $validated_data_user['uuid'] = Uuid::uuid4();

        if (strpos($validated_data_pelamar['email'], '@satunama.org') !== false) {
            $validated_data_user['role'] = 'admin';
            User::create($validated_data_user);
            $request->session()->flash('sukses', 'Berhasil Registrasi');

        } else {
            $pelamar = Pelamar::create($validated_data_pelamar);

            if ($pelamar) {
                $validated_data_user['id_pelamar'] = $pelamar->id;
                $user = User::create([
                    'username' => $validated_data_user['username'],
                    'slug' => $validated_data_user['slug'],
                    'email' => $validated_data_user['email'],
                    'password' => $validated_data_user['password'],
                    'role' => 'user',
                    'uuid' => $validated_data_user['uuid'],
                    'id_pelamar' => $validated_data_user['id_pelamar'],
                ]);
                $pelamar_id = Pelamar::find($user->id_pelamar);

                if ($pelamar_id) {
                    $pelamar_id->notify(new RegisterMessage($data_notifikasi));
                }
            }

            $request->session()->flash('sukses', 'Registrasi Berhasil');
        }

        return redirect('/login');
    }

    public function checkSlug(Request $request)
    {

        $slug = SlugService::createSlug(User::class, 'slug', $request->nama);

        return response()->json(['slug' => $slug]);
    }
}
