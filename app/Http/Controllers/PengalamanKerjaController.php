<?php

namespace App\Http\Controllers;

use App\Models\PengalamanKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengalamanKerjaController extends Controller
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
                'nama_perusahaan' => 'required',
                'email_instansi' => 'nullable',
                'posisi' => 'required',
                'periode' => 'required',
                'gaji' => 'nullable',
                'alasan_mengundurkan_diri' => 'nullable',
                'id_pelamar' => 'required',
                'telepon' => 'nullable|numeric|min_digits:11|max_digits:12|unique:pengalaman_kerja,telepon',
            ]
        );

        if ($request->gaji != null) {
            $formattedCurrency = $request->gaji; // Example formatted currency string
            $cleanedString = preg_replace('/[^\d]/', '', $formattedCurrency);
            $gaji = (int) $cleanedString;
            $validatedData['gaji'] = $gaji;
        }

        $query = PengalamanKerja::create($validatedData);

        if ($query) {
            // return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success add work experience', 'Berhasil menambah pengalaman kerja');
            return back()->with('success add work experience', 'Berhasil menambah pengalaman kerja');

        } else {
            return back()->with('error add work experience', 'Gagal menambah pengalaman kerja');
            // return redirect('/profil-kandidat/users/' . $user_slug[0])->with('error add work experience', 'Gagal menambah pengalaman kerja');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PengalamanKerja $pengalamanKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengalamanKerja $pengalamanKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengalamanKerja $pengalamanKerja)
    {
        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        $validatedData = $request->validate(
            [
                'nama_perusahaan' => 'required',
                'email_instansi' => 'required|email',
                'posisi' => 'required',
                'periode' => 'required',
                'masih_bekerja' => 'nullable',
                'gaji' => 'nullable',
                'telepon' => 'nullable|numeric|min_digits:11|max_digits:12',
                'alasan_mengundurkan_diri' => 'required'
            ]
        );

        $formattedCurrency = $request->gaji; // Example formatted currency string
        $cleanedString = preg_replace('/[^\d]/', '', $formattedCurrency);
        $gaji = (int) $cleanedString;
        $validatedData['gaji'] = $gaji;
        $query = PengalamanKerja::where('id', '=', $pengalamanKerja->id)->update($validatedData);

        if ($query) {
            return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success update work experience', 'Berhasil mengubah pengalaman kerja');
        } else {
            return redirect('/profil-kandidat/users/' . $user_slug[0])->with('error update work experience', 'Gagal mengubah pengalaman kerja');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengalamanKerja  $pengalamanKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengalamanKerja $pengalamanKerja)
    {

        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');

        PengalamanKerja::destroy($pengalamanKerja->id);

        return redirect('/profil-kandidat/users/' . $user_slug[0])->with('success delete work experience', 'Berhasil menghapus pengalaman kerja');
    }
}
