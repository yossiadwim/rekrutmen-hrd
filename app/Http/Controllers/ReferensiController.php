<?php

namespace App\Http\Controllers;

use App\Models\Referensi;
use App\Models\User;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    
    public function store(Request $request)
    {

        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        $validatedData = $request->validate([
            'nama_referensi' => 'required',
            'alamat_referensi' => 'required',
            'telepon_referensi' => 'required',
            'email_referensi' => 'required',
            'hubungan_referensi' => 'nullable',
            'posisi_referensi' => 'nullable',
            'id_pelamar' => 'required',

        ]);

        Referensi::create($validatedData);
        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success add reference', 'Berhasil menambah referensi');
    }

    
    public function update(Request $request, Referensi $referensi)
    {
        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        $validatedData = $request->validate([
            'nama_referensi' => 'required',
            'alamat_referensi' => 'required',
            'telepon_referensi' => 'nullable',
            'email_referensi' => 'required',
            'hubungan_referensi' => 'nullable',
            'posisi_referensi' => 'nullable',
            'id_pelamar' => 'required',

        ]);

        Referensi::where('id_referensi', $referensi->id_referensi)->update($validatedData);
        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success update reference', 'Berhasil mengubah referensi');

    }

    public function destroy(Referensi $referensi)
    {
        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        Referensi::destroy($referensi->id_referensi);
        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success delete reference', 'Berhasil menghapus referensi');

    }
}
