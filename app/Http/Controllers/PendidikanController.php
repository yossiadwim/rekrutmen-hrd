<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendidikan;
use App\Models\User;

class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        $validatedData = $request->validate(
            [
                'jenjang_pendidikan' => 'required',
                'jurusan' => 'nullable',
                'nama_institusi' => 'required',
                'tahun_lulus' => 'required',
                'ipk' => 'nullable',
                'id_pelamar' => 'required'
            ]
        );

        Pendidikan::create($validatedData);
        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success add education', 'Berhasil menambah informasi pendidikan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        $validatedData = $request->validate(
            [
                'jenjang_pendidikan' => 'required',
                'jurusan' => 'nullable',
                'ipk' => 'nullable',
                'nama_institusi' => 'required',
                'tahun_lulus' => 'required',
                'id_pelamar' => 'required'
            ]
        );
        Pendidikan::where('id_pendidikan', $pendidikan->id_pendidikan)->update($validatedData);
        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success update education', 'Berhasil mengubah informasi pendidikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendidikan $pendidikan)
    {
        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');
        
        Pendidikan::destroy($pendidikan->id_pendidikan);
        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success delete education', 'Berhasil menghapus pengalaman kerja');
    }
}
