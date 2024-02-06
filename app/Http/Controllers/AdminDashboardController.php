<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agama;
use App\Models\Status;
use App\Models\Pelamar;
use App\Mail\MailNotify;
use App\Models\Karyawan;
use App\Models\Lowongan;
use App\Models\Departemen;
use App\Models\Pendidikan;
use App\Models\ActivityLog;
use App\Models\TesTertulis;
use App\Models\TipeAnalisa;
use App\Models\HasilAnalisa;
use App\Models\JenisAnalisa;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;
use App\Models\StatusLamaran;
use App\Models\ApplicationForm;
use App\Models\PelamarLowongan;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReferenceCheckToCompany;
use App\Mail\ReferenceCheckToIndividu;
use App\Models\AnakPelamar;
use App\Models\KeluargaPelamar;
use App\Models\KemampuanKomputer;
use App\Models\KondisiKesehatan;
use App\Models\KontakDarurat;
use App\Models\Pelatihan;
use App\Models\PenawaranPelamar;
use App\Models\PengalamanOrganisasi;
use App\Models\PenguasaanBahasa;
use App\Models\Referensi;
use Monarobase\CountryList\CountryListFacade;
use App\Notifications\ApplicationStatusChange;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminDashboardController extends Controller
{

    public function index()
    {

        if (auth()->check()) {
            $jobsOpen = Lowongan::join('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                ->select(DB::raw('lowongan.id, lowongan.id_departemen, departemen.nama_departemen, departemen.kode_departemen, nama_lowongan, slug, lowongan.tipe_lowongan, deskripsi, lowongan.created_at, lowongan.updated_at'))
                ->where('closed', '=', 'false')
                ->where('tanggal_tutup', '>', now()->toDate())
                ->latest();

            $jobsClose = Lowongan::join('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                ->select(DB::raw('lowongan.id, lowongan.id_departemen, departemen.nama_departemen, departemen.kode_departemen, nama_lowongan, slug, lowongan.tipe_lowongan, deskripsi, lowongan.created_at, lowongan.updated_at'))
                ->where('closed', '=', 'true')
                ->orwhere('tanggal_tutup', '<', now()->toDate())
                ->latest();

            $lowongans = Lowongan::all();

            if (count($lowongans) != 0) {

                foreach ($lowongans as $lowongan) {
                    $notifikasi_lowongan_unread[] = $lowongan->unreadNotifications;
                }

                foreach ($lowongans as $lowongan) {
                    $notifikasi_lowongan_read[] = $lowongan->readNotifications;
                }

                return view('dashboard.admin_dashboard', [

                    'jobsOpen' => $jobsOpen->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen', 'sort']))->get(),

                    'jobsClose' => $jobsClose->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen', 'sort']))->get(),

                    'departemens' => Lowongan::rightJoin('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                        ->select(DB::raw('count(lowongan.nama_lowongan) as total_lowongan, departemen.id_departemen as id_departemen, nama_departemen, kode_departemen'))
                        ->groupBy('departemen.id_departemen')
                        ->get(),

                    'user' => Auth::user(),
                    'notifikasi_unread' => $notifikasi_lowongan_unread,
                    'notifikasi_read' => $notifikasi_lowongan_read
                ]);
            } else {
                return view('dashboard.admin_dashboard', [

                    'jobsOpen' => $jobsOpen->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen', 'sort']))->get(),

                    'jobsClose' => $jobsClose->search(request('search'))->filter(request(['tanggal', 'tipe_lowongan', 'kode_departemen', 'sort']))->get(),

                    'departemens' => Lowongan::rightJoin('departemen', 'lowongan.id_departemen', '=', 'departemen.id_departemen')
                        ->select(DB::raw('count(lowongan.nama_lowongan) as total_lowongan, departemen.id_departemen as id_departemen, nama_departemen, kode_departemen'))
                        ->groupBy('departemen.id_departemen')
                        ->get(),

                    'user' => Auth::user(),

                ]);
            }
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check()) {
            return view('crud_lowongan.create_lowongan', [
                'departemen' => Departemen::all(),
                'user' => Auth::user(),
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_departemen' => 'required',
            'nama_lowongan' => 'required',
            'slug' => 'required',
            'tipe_lowongan' => 'required',
            'deskripsi' => 'required',
            'closed' => 'required',
            'tanggal_tutup' => 'required|date',

        ]);

        Lowongan::create($validatedData);
        return redirect('/admin-dashboard/lowongan')->with('success add', 'Lowongan Berhasil Dibuat');
    }

    public function show(Lowongan $lowongan)
    {

        if (auth()->check()) {
            $arrPengalamanId = PengalamanKerja::all()->pluck('id_pelamar')->toArray();
            $arrPendidikanId = Pendidikan::all()->pluck('id_pelamar')->toArray();
            $status = Status::all();

            //Data Review
            $review_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'lowongan',
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 1);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            //Data Seleksi Berkas
            $seleksi_berkas_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 2);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            //Data Reference Check
            $reference_check_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 3);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            //Data Tes
            $tes_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 4);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            //Data Penawaran
            $penawaran_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 5);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            $direkrut_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 6);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            $ditolak_datas = Lowongan::find($lowongan->id)->pelamarLowongan()->with([
                'pelamar' => [
                    'pendidikan',
                    'pengalamanKerja',
                    'referensi',
                    'user',

                ],
                'dokumenPelamarLowongan' => [
                    'dokumenPelamar',
                ],
                'statusLamaran' => [
                    'status' => function ($query) {
                        $query->where('id', 7);
                    }
                ],
                'activityLog',
            ])->get()->toArray();

            $review_data = [];
            for ($i = 0; $i < count($review_datas); $i++) {
                if ($review_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $review_data[] = $review_datas[$i];
                }
            }

            $seleksi_berkas_data = [];
            for ($i = 0; $i < count($seleksi_berkas_datas); $i++) {
                if ($seleksi_berkas_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $seleksi_berkas_data[] = $seleksi_berkas_datas[$i];
                }
            }

            $reference_check_data = [];
            for ($i = 0; $i < count($reference_check_datas); $i++) {
                if ($reference_check_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $reference_check_data[] = $reference_check_datas[$i];
                }
            }

            $tes_data = [];
            for ($i = 0; $i < count($tes_datas); $i++) {
                if ($tes_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $tes_data[] = $tes_datas[$i];
                }
            }

            $penawaran_data = [];
            for ($i = 0; $i < count($penawaran_datas); $i++) {
                if ($penawaran_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $penawaran_data[] = $penawaran_datas[$i];
                }
            }

            $direkrut_data = [];
            for ($i = 0; $i < count($direkrut_datas); $i++) {
                if ($direkrut_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $direkrut_data[] = $direkrut_datas[$i];
                }
            }

            $ditolak_data = [];
            for ($i = 0; $i < count($ditolak_datas); $i++) {
                if ($ditolak_datas[$i]['status_lamaran'][0]['status'] != null) {
                    $ditolak_data[] = $ditolak_datas[$i];
                }
            }

            $all_lowongan = Lowongan::all();
            foreach ($all_lowongan as $data_lowongan) {
                $notifikasi_lowongan_unread[] = $data_lowongan->unreadNotifications;
            }

            foreach ($all_lowongan as $data_lowongan) {
                $notifikasi_lowongan_read[] = $data_lowongan->readNotifications;
            }

            return view('dashboard.kelola_kandidat', [
                'lowongan' => $lowongan,
                'datas' => $lowongan->pelamarLowongan->load([
                    'pelamar.user',
                    'pelamar.pendidikan',
                    'pelamar.pengalamanKerja'

                ]),
                'arrPengalamanId' => $arrPengalamanId,
                'arrPendidikanId' => $arrPendidikanId,
                'status' => $status,
                'review' => $review_data,
                'seleksi_berkas' => $seleksi_berkas_data,
                'reference_check' => $reference_check_data,
                'tes' => $tes_data,
                'penawaran' => $penawaran_data,
                'direkrut' => $direkrut_data,
                'ditolak' => $ditolak_data,
                'user' => Auth::user(),
                'notifikasi_unread' => $notifikasi_lowongan_unread,
                'notifikasi_read' => $notifikasi_lowongan_read,

            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lowongan $lowongan)
    {

        if (auth()->check()) {

            return view('crud_lowongan.edit_lowongan', [
                'lowongan' => $lowongan,
                'departemen' => Departemen::all(),
                'user' => Auth::user(),
            ]);
        } else {

            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lowongan $lowongan)
    {
        $rules = [
            'nama_lowongan' => 'required|string',
            'id_departemen' => 'required',
            'tipe_lowongan' => 'required',
            'deskripsi' => 'required|string',
            'tanggal_tutup' => 'required|date',
        ];

        if ($request->slug != $lowongan->slug) {
            $rules['slug'] = 'required|unique:lowongan';
        }

        $validatedData = $request->validate($rules);
        Lowongan::where('id', $lowongan->id)->update($validatedData);

        return redirect('/admin-dashboard/lowongan')->with('success edit', 'Lowongan Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lowongan $lowongan)
    {
    }

    public function checkSlug(Request $request)
    {

        $slug = SlugService::createSlug(Lowongan::class, 'slug', $request->nama_lowongan);

        return response()->json(['slug' => $slug]);
    }

    public function closeJobs(Request $request, Lowongan $lowongan)
    {
        $data = [
            'closed' => $request->closed,
            'tanggal_tutup' => $request->tanggal_tutup
        ];

        Lowongan::where('id', $lowongan->id)->update($data);

        return redirect('/admin-dashboard/lowongan')->with('success closed', 'Lowongan Berhasil Ditutup');
    }

    public function activatedJob(Request $request, Lowongan $lowongan)
    {

        // dd($lowongan);
        $validatedData = $request->validate([
            'tanggal_tutup' => 'required|date',
            'closed' => 'required',
        ]);

        $query =  Lowongan::where('id', $lowongan->id)->update($validatedData);
        if ($query) {
            return redirect('/admin-dashboard/lowongan')->with('success activated', 'Lowongan Berhasil Dibuka Kembali');
        }

        return redirect('/admin-dashboard/lowongan')->with('error activated', 'Lowongan Gagal Dibuka Kembali');
    }

    public function changePosition(Request $request, StatusLamaran $statusLamaran)
    {

        $validatedData = $request->validate([
            'tanggal' => 'required',
            'approved_by' => 'required',
            'id_status' => 'required'
        ]);

        $statusLamaran->where('id_status_lamaran', $statusLamaran->id_status_lamaran)->update($validatedData);

        $data_activity = [
            'id_pelamar_lowongan' => $request->id_pelamar_lowongan,
            'id_status' => $request->id_status
        ];

        $lowongan = PelamarLowongan::join('lowongan', 'pelamar_lowongan.id_lowongan', 'lowongan.id')
            ->where('pelamar_lowongan.id_pelamar_lowongan', $request->id_pelamar_lowongan)
            ->select(DB::raw('nama_lowongan,slug,tanggal_melamar'))
            ->get();

        $slug_user = User::join('pelamar', 'users.id_pelamar', 'pelamar.id')
            ->join('pelamar_lowongan', 'pelamar.id', 'pelamar_lowongan.id_pelamar')
            ->where('pelamar_lowongan.id_pelamar_lowongan', '=', $request->id_pelamar_lowongan)
            ->select('users.slug', 'users.id_pelamar', 'users.id')
            ->get();

        $data_email = [
            'subject' => 'YAYASAN SATUNAMA - Pemberitahuan Pergantian Status Lamaran',
            'email' => $request->email,
            'status' => $request->status_kandidat,
            'nama_pelamar' => $request->nama_pelamar,
            'slug_pelamar' => $request->slug_pelamar,
            'slug_lowongan' => $request->slug_lowongan,
            'nama_lowongan' => $lowongan[0]->nama_lowongan,
            'tanggal_melamar' => $lowongan[0]->tanggal_melamar,
            'nama_karyawan' => $request->nama_karyawan

        ];

        $data_notifikasi = [
            'subject' => 'Pemberitahuan Pergantian Status Lamaran',
            'status' => $request->status_kandidat,
            'nama_pelamar' => $request->nama_pelamar,
            'nama_lowongan' => $lowongan[0]->nama_lowongan,
            'tanggal_melamar' => $lowongan[0]->tanggal_melamar,
            'nama_karyawan' => $request->nama_karyawan,
            'id_user' => $slug_user[0]->id,
        ];


        Mail::to($data_email['email'])->send(new MailNotify($data_email));
        ActivityLog::create($data_activity);

        if ($request->status_kandidat == 'penawaran') {
            PenawaranPelamar::create(['id_pelamar_lowongan' => $request->id_pelamar_lowongan]);
        }

        $pelamar = Pelamar::find($slug_user[0]->id_pelamar);
        $pelamar->notify(new ApplicationStatusChange($data_notifikasi));

        return redirect('/admin-dashboard/lowongan/' . $lowongan[0]->slug . '/detail-pelamar/' . $slug_user[0]->slug)->with('success change position', 'Berhasil Mengubah Posisi Kandidat');
    }



    public function referenceCheck(Request $request, Lowongan $lowongan)
    {
        $data_email_reference_check_to_individu = [
            'nama_pelamar' => $request->nama_pelamar,
            'nama_referensi' => $request->nama_referensi,
            'email_referensi' => $request->email_referensi,
            'nama_lowongan' => $request->nama_lowongan,
            'nama_karyawan' => $request->nama_karyawan,
            'email_karyawan' => $request->email_karyawan
        ];
        $data_email_reference_check_to_company = [
            'nama_pelamar' => $request->nama_pelamar,
            'nama_perusahaan' => $request->nama_perusahaan,
            'posisi' => $request->posisi,
            'email_referensi' => $request->email_referensi,
            'nama_lowongan' => $request->nama_lowongan,
            'nama_karyawan' => $request->nama_karyawan,
            'email_karyawan' => $request->email_karyawan
        ];
        if ($request->nama_perusahaan) {
            Mail::to($data_email_reference_check_to_company['email_referensi'])->send(new ReferenceCheckToCompany($data_email_reference_check_to_company));
        } else {
            Mail::to($data_email_reference_check_to_individu['email_referensi'])->send(new ReferenceCheckToIndividu($data_email_reference_check_to_individu));
        }

        $slug_user = User::join('pelamar', 'users.id_pelamar', 'pelamar.id')
            ->where('pelamar.nama_pelamar', '=', $request->nama_pelamar)
            ->select('users.slug')
            ->get();

        return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/detail-pelamar/' . $slug_user[0]->slug)->with('success send refererence check', 'Berhasil Mengirim Email Reference Check');
    }

    public function workLoad(Lowongan $lowongan, User $user)
    {

        $pelamar_lowongan = $user->join('pelamar', 'pelamar.id', 'users.id_pelamar')
            ->join('pelamar_lowongan', 'pelamar_lowongan.id_pelamar', 'pelamar.id')
            ->join('lowongan', 'pelamar_lowongan.id_lowongan', 'lowongan.id')
            ->where('lowongan.id', $lowongan->id)
            ->where('users.id', $user->id)
            ->get();

        $total_poin = HasilAnalisa::join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
            ->selectRaw('SUM(hasil_analisa.poin) as total_poin')
            ->where('hasil_analisa.id_pelamar_lowongan',  $pelamar_lowongan[0]->id_pelamar_lowongan)
            ->get();

        $gaji = KomponenGaji::whereRaw(
            '(SELECT SUM(poin) FROM hasil_analisa WHERE hasil_analisa.id_pelamar_lowongan = ?) 
                BETWEEN komponen_gaji.bobot_minimal AND komponen_gaji.bobot_maksimal order by komponen_gaji.id_komponen_gaji DESC',
            [$pelamar_lowongan[0]->id_pelamar_lowongan]
        )->get();

        $hasil_analisa = HasilAnalisa::where('id_pelamar_lowongan',  $pelamar_lowongan[0]->id_pelamar_lowongan)->get();
        $data_penawaran = PenawaranPelamar::where('id_pelamar_lowongan',   $pelamar_lowongan[0]->id_pelamar_lowongan)->get();
        $data_penawaran_exist = PenawaranPelamar::where('id_pelamar_lowongan',  $pelamar_lowongan[0]->id_pelamar_lowongan)->exists();

        $penawaran_pelamar_id = DB::table('penawaran_pelamar')->select(['*'])->pluck('id_pelamar_lowongan')->toArray();

        return view('dashboard.kelola_kandidat.bobot_kerja_kandidat', [
            'title' => 'Bobot Kerja',
            'user' => $user,
            'data_lowongan' => $user->pelamar->pelamarLowongan->load(
                'lowongan',
                'pelamar',
                'statusLamaran.status'
            ),
            'hasil_analisa' => $hasil_analisa,
            'poin' => $total_poin,
            'gaji' => $gaji,
            'lowongan' => $lowongan,
            'penawaran_pelamar_id' => $penawaran_pelamar_id,
            'data_penawaran' => $data_penawaran,
            'data_penawaran_exist' => $data_penawaran_exist
        ]);
    }


    public function detailCandidate(Lowongan $lowongan, User $user)
    {
        if (auth()->check()) {
            $arrPengalamanId = PengalamanKerja::all()->pluck('id_pelamar')->toArray();
            $arrPendidikanId = Pendidikan::all()->pluck('id_pelamar')->toArray();

            $pelamar_lowongan = PelamarLowongan::join('pelamar', 'pelamar_lowongan.id_pelamar', 'pelamar.id')
                ->join('lowongan', 'lowongan.id', 'pelamar_lowongan.id_lowongan')
                ->join('users', 'users.id_pelamar', 'pelamar.id')
                ->select('pelamar_lowongan.id_pelamar_lowongan')
                ->where('users.id', $user->id)
                ->where('lowongan.id', $lowongan->id)
                ->get();


            $data_hasil_analisa = HasilAnalisa::join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
                ->where('hasil_analisa.id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->get();


            $hasil_analisa_exists = HasilAnalisa::join('jenis_analisa', 'jenis_analisa.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
                ->join('tipe_analisa', 'tipe_analisa.id_tipe_analisa', 'jenis_analisa.id_tipe_analisa')
                ->select('tipe_analisa.id_tipe_analisa')
                ->where('hasil_analisa.id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->get();

            $applicationformId = ApplicationForm::all()->pluck('id_pelamar_lowongan')->toArray();
            $status = Status::select('status.id', 'status.nama_status')->get();

            $current_status_lamaran = StatusLamaran::where('id_pelamar_lowongan', '=', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->select('status_lamaran.id_status')
                ->get();

            $current_status = Status::where('id', '=', $current_status_lamaran[0]->id_status)
                ->select('status.nama_status')
                ->get();


            $search_status = $current_status[0]->nama_status;
            $index_current_status = $status->search(function ($stat) use ($search_status) {
                return $stat->nama_status === $search_status;
            });


            if ($index_current_status !== false) {
                if ($index_current_status == 6) {
                    $get_data_current_status = $status->get($index_current_status);
                    $data_next_status = Status::where('nama_status', $get_data_current_status->nama_status)->get();
                } else {
                    $index_next_status = $index_current_status + 1;
                    if ($status->has($index_current_status)) {
                        $next_status = $status->get($index_next_status);
                        // $data_next_status = Status::where('nama_status', $next_status->nama_status)->get();
                        $data_next_status = Status::where('nama_status', $next_status->nama_status)->get();
                    }
                }
            }

            $lowongans = Lowongan::all();
            foreach ($lowongans as $data_lowongan) {
                $notifikasi_lowongan_unread[] = $data_lowongan->unreadNotifications;
            }

            foreach ($lowongans as $data_lowongan) {
                $notifikasi_lowongan_read[] = $data_lowongan->readNotifications;
            }

            return view('dashboard.detail_kandidat', [
                'arrPengalamanId' => $arrPengalamanId,
                'arrPendidikanId' => $arrPendidikanId,
                'applicationFormId' => $applicationformId,
                'title' => 'Detail Kandidat',
                'status' => Status::all(),
                'data_status_ditolak' => Status::orderBy('status.id', 'desc')->first(),
                'data_next_status' => $data_next_status,
                'lowongan' => $lowongan,
                'data_hasil_analisa' => $data_hasil_analisa,
                'tipe_analisa' => TipeAnalisa::all()->sortBy('id_tipe_analisa'),
                'data_penawaran' => PenawaranPelamar::where('id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)->get(),
                'data_penawaran_exist' => PenawaranPelamar::where('id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)->exists(),
                'data_hasil_analisa' => $data_hasil_analisa,
                'hasil_analisa_exists' => $hasil_analisa_exists,
                'datas' => $user->pelamar->pelamarLowongan->load(
                    'lowongan',
                    'pelamar.user',
                    'pelamar.pendidikan',
                    'pelamar.pengalamanKerja',
                    'pelamar.referensi',
                    'dokumenPelamarLowongan.dokumenPelamar',
                    'statusLamaran.status',
                    'lowongan',
                    'activityLog',
                    'tesTertulis',

                ),
                'user' => Auth::user(),
                'notifikasi_unread' => $notifikasi_lowongan_unread,
                'notifikasi_read' => $notifikasi_lowongan_read,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function instrumenAnalisaBebanKerja(Lowongan $lowongan, User $user, JenisAnalisa $jenis_analisa)
    {

        if (auth()->check()) {
            $pelamar_lowongan = $user->join('pelamar', 'pelamar.id', 'users.id_pelamar')
                ->join('pelamar_lowongan', 'pelamar_lowongan.id_pelamar', 'pelamar.id')
                ->join('lowongan', 'pelamar_lowongan.id_lowongan', 'lowongan.id')
                ->where('lowongan.id', $lowongan->id)
                ->where('users.id', $user->id)
                ->get();

            $analisa_pendidikan = $jenis_analisa->bebanIndeksPendidikan()->get();

            $analisa_pengalaman = $jenis_analisa->bebanIndeksPengalaman()->get();

            $analisa_keterampilan_hubungan = $jenis_analisa->bebanIndeksKeterampilanHubungan()->get();

            $analisa_manajemen = $jenis_analisa->bebanIndeksManajemen()->get();

            $analisa_tantangan_berpikir = $jenis_analisa->bebanIndeksTantanganBerpikir()->get();

            $analisa_lingkungan_berpikir = $jenis_analisa->bebanIndeksLingkunganBerpikir()->get();

            $analisa_tingkatan_kebebasan_bertindak = $jenis_analisa->bebanIndeksKebebasanBertindak()->get();

            $analisa_sikap_dan_besaran_dampak = $jenis_analisa->bebanIndeksSikapDanBesaranDampak()->get();

            $analisa_signifikansi_area_dampak = $jenis_analisa->bebanIndeksSignifikansiAreaDampak()->get();

            $data_hasil_analisa = HasilAnalisa::join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
                ->where('hasil_analisa.id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->get();

            $data_hasil_analisa_exists = HasilAnalisa::join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
                ->where('hasil_analisa.id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->exists();


            $total_poin = HasilAnalisa::join('jenis_analisa_kriteria', 'jenis_analisa_kriteria.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
                ->selectRaw('SUM(hasil_analisa.poin) as total_poin')
                ->where('hasil_analisa.id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->get();

            $hasil_analisa_exists = HasilAnalisa::join('jenis_analisa', 'jenis_analisa.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
                ->join('tipe_analisa', 'tipe_analisa.id_tipe_analisa', 'jenis_analisa.id_tipe_analisa')
                ->select('tipe_analisa.id_tipe_analisa')
                ->where('hasil_analisa.id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)
                ->get();

            $lowongans = Lowongan::all();
            foreach ($lowongans as $data_lowongan) {
                $notifikasi_lowongan_unread[] = $data_lowongan->unreadNotifications;
            }

            foreach ($lowongans as $data_lowongan) {
                $notifikasi_lowongan_read[] = $data_lowongan->readNotifications;
            }

            return view('dashboard.instrumen_analisa_beban_kerja', [
                'user' => Auth::user(),
                'lowongan' => $lowongan,
                'tipe_analisa' => TipeAnalisa::all()->sortBy('id_tipe_analisa'),
                'data_hasil_analisa' => $data_hasil_analisa,
                'data_hasil_analisa_exists' => $data_hasil_analisa_exists,
                'total_poin' => $total_poin,
                'hasil_analisa_exists' => $hasil_analisa_exists,
                'analisa_pendidikan' => $analisa_pendidikan,
                'analisa_pengalaman' => $analisa_pengalaman,
                'analisa_keterampilan_hubungan' => $analisa_keterampilan_hubungan,
                'analisa_manajemen' => $analisa_manajemen,
                'analisa_tantangan_berpikir' => $analisa_tantangan_berpikir,
                'analisa_lingkungan_berpikir' => $analisa_lingkungan_berpikir,
                'analisa_tingkatan_kebebasan_bertindak' => $analisa_tingkatan_kebebasan_bertindak,
                'analisa_sikap_dan_besaran_dampak' => $analisa_sikap_dan_besaran_dampak,
                'analisa_signifikansi_area_dampak' => $analisa_signifikansi_area_dampak,
                'data_pelamar' => $user,
                'pelamar_lowongan' => $pelamar_lowongan,
                'notifikasi_unread' => $notifikasi_lowongan_unread,
                'notifikasi_read' => $notifikasi_lowongan_read,

            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }


    private function insertUpdateAnalisa(object $request, bool $data_hasil_analisa_exists, object $data)
    {


        $data_hasil_analisa = [
            'id_jenis_analisa' => $request->id_jenis_analisa,
            'id_lowongan' => $request->id,
            'id_pelamar_lowongan' => $request->id_pelamar_lowongan,
            'id_karyawan' => $request->id_karyawan,
        ];

        $data_update_analisa = [
            'id_jenis_analisa' => $request->id_jenis_analisa,
            'id_pelamar_lowongan' => $request->id_pelamar_lowongan,
        ];

        $poin = $request->bobot * $request->indeks;
        $data_hasil_analisa['poin'] = $poin;
        $data_update_analisa['poin'] = $poin;

        if ($data_hasil_analisa_exists) {
            $query = HasilAnalisa::where('hasil_analisa.id_jenis_analisa', $data[0]->id_jenis_analisa)
                ->where('hasil_analisa.id_pelamar_lowongan', $request->id_pelamar_lowongan)
                ->update($data_update_analisa);
            return true;
        }

        $query = HasilAnalisa::create($data_hasil_analisa);
        if ($query) {
            return true;
        }
    }


    public function instrumentAnalysis(Lowongan $lowongan, User $user, Request $request)
    {
        $data_hasil_analisa_exists = HasilAnalisa::join('jenis_analisa', 'jenis_analisa.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->where('hasil_analisa.id_pelamar_lowongan', $request->id_pelamar_lowongan)
            ->where('tipe_analisa.id_tipe_analisa', $request->id_tipe_analisa)
            ->exists();

        $data = HasilAnalisa::join('jenis_analisa', 'jenis_analisa.id_jenis_analisa', 'hasil_analisa.id_jenis_analisa')
            ->join('tipe_analisa', 'jenis_analisa.id_tipe_analisa', 'tipe_analisa.id_tipe_analisa')
            ->where('hasil_analisa.id_pelamar_lowongan', $request->id_pelamar_lowongan)
            ->where('tipe_analisa.id_tipe_analisa', $request->id_tipe_analisa)
            ->get();
        if ($request->slug_analisa == 'pendidikan') {
            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'pengalaman') {
            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'keterampilan-hubungan-dengan-pihak-lain') {
            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'manajemen') {

            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'tantangan-berpikir') {
            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'lingkungan-berpikir') {

            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'tingkatan-kebebasan-bertindak') {

            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'sikap-dan-besaran-dampak') {

            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        } else if ($request->slug_analisa == 'signifikansi-area-dampak') {

            if ($this->insertUpdateAnalisa($request, $data_hasil_analisa_exists, $data)) {
                return redirect('/admin-dashboard/lowongan/' . $lowongan->slug . '/instrumen-penilaian-beban-kerja/' . $user->slug)->with('success add education analysis', 'Berhasil Memasukkan Data');
            }
        }
    }

    public function viewApplicationForms(Lowongan $lowongan, User $user)
    {

        if (auth()->check()) {

            $countries = CountryListFacade::getList('en');
            $anakId = AnakPelamar::all()->pluck('id_pelamar')->toArray();
            $keluargaId = KeluargaPelamar::all()->pluck('id_pelamar')->toArray();
            $kemampuanKomputerId = KemampuanKomputer::all()->pluck('id_pelamar')->toArray();
            $kondisiKesehatanId = KondisiKesehatan::all()->pluck('id_pelamar')->toArray();
            $kontakDaruratId = KontakDarurat::all()->pluck('id_pelamar')->toArray();
            $pengalamanOrgId = PengalamanOrganisasi::all()->pluck('id_pelamar')->toArray();
            $penguasaanBahasaId = PenguasaanBahasa::all()->pluck('id_pelamar')->toArray();
            $pelatihanId = Pelatihan::all()->pluck('id_pelamar')->toArray();
            $pendidikanId = Pendidikan::all()->pluck('id_pelamar')->toArray();
            $pengalamanKerjaId = PengalamanKerja::all()->pluck('id_pelamar')->toArray();
            $referensiId = Referensi::all()->pluck('id_pelamar')->toArray();
            $lowongans = Lowongan::all();
            foreach ($lowongans as $data_lowongan) {
                $notifikasi_lowongan_unread[] = $data_lowongan->unreadNotifications;
            }

            foreach ($lowongans as $data_lowongan) {
                $notifikasi_lowongan_read[] = $data_lowongan->readNotifications;
            }


            return view('dashboard.application_form', [
                'title' => 'Application Form',
                'user' => $user,
                'lowongan' => $lowongan,
                'anakId' => $anakId,
                'keluargaId' => $keluargaId,
                'kemampuanKomputerId' => $kemampuanKomputerId,
                'kondisiKesehatanId' => $kondisiKesehatanId,
                'kontakDaruratId' => $kontakDaruratId,
                'pengalamanOrgId' => $pengalamanOrgId,
                'penguasaanBahasaId' => $penguasaanBahasaId,
                'pelatihanId' => $pelatihanId,
                'pendidikanId' => $pendidikanId,
                'pengalamanKerjaId' => $pengalamanKerjaId,
                'referensiId' => $referensiId,
                'datas' => $user->pelamar->pelamarLowongan->load(
                    'lowongan',
                    'pelamar.user',
                    'pelamar.pendidikan',
                    'pelamar.pengalamanKerja',
                    'pelamar.referensi',
                    'pelamar.pelatihan',
                    'pelamar.kondisiKesehatan',
                    'pelamar.kemampuanKomputer',
                    'pelamar.keluargaPelamar',
                    'pelamar.anakPelamar',
                    'pelamar.kontakDarurat',
                    'pelamar.pengalamanOrganisasi',
                    'statusLamaran.status',

                ),
                'countries' => $countries,
                'religions' => Agama::all(),
                'notifikasi_unread' => $notifikasi_lowongan_unread,
                'notifikasi_read' => $notifikasi_lowongan_read,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function sendOffering(Request $request, User $user)
    {

        $pelamar_lowongan = $user->join('pelamar', 'pelamar.id', 'users.id_pelamar')
            ->join('pelamar_lowongan', 'pelamar_lowongan.id_pelamar', 'pelamar.id')
            ->join('lowongan', 'pelamar_lowongan.id_lowongan', 'lowongan.id')
            ->where('lowongan.id', $request->id_lowongan)
            ->where('users.id', $user->id)
            ->get();


        $data_penawaran = [
            'kisaran_gaji' => $request->kisaran_gaji,
            'sudah_terkirim' => $request->sudah_terkirim
        ];

        if ($request->gaji_final != null) {
            $formattedCurrency = $request->gaji_final; // Example formatted currency string
            $cleanedString = preg_replace('/[^\d]/', '', $formattedCurrency);
            $gaji_final = (int) $cleanedString;
            $data_penawaran['gaji_final'] = $gaji_final;
        }

        if ($request->status_penawaran != null) {
            $data_penawaran['status_penawaran'] = $request->status_penawaran;
        }

        $existingId = PenawaranPelamar::where('id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)->first();

        if ($existingId) {
            $existingId->update($data_penawaran);
            return back();
        } else {
            $existingId->create($data_penawaran);
            return back();
        }
    }

    public function markasread($id)
    {
        if ($id) {

            $lowongans = Lowongan::all();
            foreach ($lowongans as $lowongan) {
                $lowongan->notifications->where('id', $id)->markAsRead();
            }
        }
        return back();
    }
}
