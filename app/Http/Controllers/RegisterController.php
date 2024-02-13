<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Pelamar;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\RegisterMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use \Cviebrock\EloquentSluggable\Services\SlugService;


class RegisterController extends Controller
{

    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }

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
            'username' => 'nullable|max:255',
            'slug' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255|confirmed',

        ]);

        $validated_data_user['password'] = Hash::make($validated_data_user['password']);
        $validated_data_user['uuid'] = Uuid::uuid4();

        $user_properties = [
            'email' => $validated_data_user['email'],
            'password' => $validated_data_user['password'],
        ];

        if (strpos($validated_data_pelamar['email'], '@satunama.org') !== false) {

            $validated_data_user['role'] = 'admin';
            $user_firebase = $this->firebaseAuth->createUserWithEmailAndPassword($validated_data_user['email'], $request->input('password'));

            if ($user_firebase) {
                User::create($validated_data_user);
            }
            $request->session()->flash('sukses', 'Berhasil Registrasi');
        } 
        
        else {
            $user_firebase = $this->firebaseAuth->createUserWithEmailAndPassword($validated_data_user['email'], $request->input('password'));

            if ($user_firebase) {
                $pelamar = Pelamar::create($validated_data_pelamar);
            }
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
