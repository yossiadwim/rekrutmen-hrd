<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Pelamar;
use App\Models\Lowongan;
use App\Models\Departemen;
use App\Models\Pendidikan;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\StatusLamaran;
use App\Models\DokumenPelamar;
use Illuminate\Support\Carbon;
use App\Models\PelamarLowongan;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DokumenPelamarLowongan;
use App\Models\Referensi;
use App\Notifications\NewApplication;
use Illuminate\Support\Facades\Storage;

class LowonganKerjaController extends Controller
{

    public function index()
    {
        try {
            $user = Auth::user();
            $lowonganOpen = Lowongan::join('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                ->select(DB::raw('lowongan.id, lowongan.id_departemen, departemen.nama_departemen, departemen.kode_departemen, nama_lowongan, slug, lowongan.tipe_lowongan, deskripsi, lowongan.created_at, lowongan.updated_at'))
                ->where('closed', '=', 'false')
                ->where('tanggal_tutup', '>', now()->toDate())
                ->latest();

            $lowonganClosed = Lowongan::join('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                ->select(DB::raw('lowongan.id, lowongan.id_departemen, departemen.nama_departemen, departemen.kode_departemen, nama_lowongan, slug, lowongan.tipe_lowongan, deskripsi, lowongan.created_at, lowongan.updated_at'))
                ->where('closed', '=', 'true')
                ->orwhere('tanggal_tutup','<', now()->toDate())
                ->latest();

            if ($user) {

                $pelamar = Pelamar::find($user->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;

                return view('lowongan.lowongan_kerja', [

                    'lowongans' => Lowongan::all(),

                    'departemens' => Lowongan::rightJoin('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                        ->select(DB::raw('count(lowongan.nama_lowongan) as total_lowongan, departemen.id_departemen as id_departemen, nama_departemen, kode_departemen'))
                        ->groupBy('departemen.id_departemen')
                        ->get(),

                    'lowonganOpen' => $lowonganOpen->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen']))->get(),

                    'lowonganClosed' => $lowonganClosed->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen']))->get(),

                    'user' => $user,

                    'notifikasi_unread' => $notifikasi_unread,
                    'notifikasi_read' => $notifikasi_read,

                    'title' => 'Lowongan Kerja'

                ]);
            } else {
                return view('lowongan.lowongan_kerja', [

                    'lowongans' => Lowongan::all(),

                    'departemens' => Lowongan::rightJoin('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                        ->select(DB::raw('count(lowongan.nama_lowongan) as total_lowongan, departemen.id_departemen as id_departemen, nama_departemen, kode_departemen'))
                        ->groupBy('departemen.id_departemen')
                        ->get(),

                    'lowonganOpen' => $lowonganOpen->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen']))->get(),

                    'lowonganClosed' => $lowonganClosed->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen']))->get(),

                    'title' => 'Lowongan Kerja'

                ]);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function show(Lowongan $lowongan)
    {
        $user = Auth::user();
        if ($user) {
            $pelamar = Pelamar::find($user->id_pelamar);
            $notifikasi_unread = $pelamar->unreadNotifications;
            $notifikasi_read = $pelamar->readNotifications;
            $arrPengalamanId = PengalamanKerja::all()->pluck('id_pelamar')->toArray();
            $arrPendidikanId = Pendidikan::all()->pluck('id_pelamar')->toArray();
            $arrReferensiId = Referensi::all()->pluck('id_pelamar')->toArray();
            return view('lowongan.detail_lowongan_kerja', [
                "arrPendidikanId" => $arrPendidikanId,
                "arrPengalamanId" => $arrPengalamanId,
                "arrReferensiId" => $arrReferensiId,
                "lowongan" => $lowongan,
                "departemen" => Departemen::where('id_departemen', $lowongan->id_departemen),
                "user" => Auth::user(),
                "pelamarExist" => PelamarLowongan::where('id_pelamar', auth()->user()->id_pelamar)->where('id_lowongan', $lowongan->id)->exists(),
                "title" => "Detail Lowongan Kerja",
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read
            ]);
        } else {

            return view('lowongan.detail_lowongan_kerja', [
                "lowongan" => $lowongan,
                "departemen" => Departemen::where('id_departemen', $lowongan->id_departemen),
                "user" => Auth::user(),
                "pelamarExist" => null,
                "title" => "Detail Lowongan Kerja"
            ]);
        }
    }

    public function filterByDepartement(Departemen $departemen)
    {
        return view('lowongan.filter_lowongan', [
            'title' => 'Filter',
            'lowongans' => Lowongan::where('id_departemen', $departemen->id_departemen)->get(),
            'departemen' => $departemen,
            'user' => Auth::user()
        ]);
    }

    public function apply(Request $request, Lowongan $lowongan)
    {

        // $request->validate([
        //     'dokumen' => 'required|array|min:3|max:3',
        //     'dokumen.*' => '|mimes:pdf',
        // ]);

        $request->validate([
            'surat_lamaran' => 'required|file|mimes:pdf',
            'cv' => 'required|file|mimes:pdf',
            'ijasah' => 'required|file|mimes:pdf',
        ]);

        $pelamar_lowongan = PelamarLowongan::create([
            'id_pelamar' => $request->input('id_pelamar'),
            'id_lowongan' => $lowongan->id,
            'tanggal_melamar' => Carbon::now()
        ]);

        $user = User::where('id', auth()->user()->id)->get();
        $user_slug = $user->pluck('slug');
        $directory = 'document/' . $user_slug[0] . '/' . $lowongan->slug;
        Storage::makeDirectory($directory);


        if ($request->files) {
            foreach ($request->files as $file) {
                $nama_file = $file->getClientOriginalName();
                $path = Storage::putFileAs($directory, $file, $nama_file);

                $dokumen_pelamar = DokumenPelamar::create([
                    'nama_dokumen' => $nama_file,
                    'path' => $path,
                ]);

                DokumenPelamarLowongan::create([
                    'id_dokumen' => $dokumen_pelamar->id,
                    'id_pelamar_lowongan' => $pelamar_lowongan->id_pelamar_lowongan
                ]);
            }
        }

        $data_notifikasi = [
            'subject' => 'Pemberitahuan Pelamar Baru',
            'nama_pelamar' => $request->nama_pelamar,
            'nama_lowongan' => $lowongan->nama_lowongan,
            'tanggal_melamar' => $pelamar_lowongan->tanggal_melamar,
        ];

        $lowongan->notify(new NewApplication($data_notifikasi));


        StatusLamaran::create([
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'id_status' => 1,
            'id_pelamar_lowongan' => $pelamar_lowongan->id_pelamar_lowongan
        ]);

        return back()->with('success', 'Dokumen berhasil diunggah');
    }

    public function markAsRead($id)
    {
        if ($id) {
            $pelamar =  Pelamar::find(auth()->user()->id_pelamar);
            $pelamar->notifications->where('id', $id)->markAsRead();
        }
        return back();
    }
}
