<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Agama;
use App\Models\Pelamar;
use App\Models\Pelatihan;
use App\Models\Referensi;
use App\Models\Pendidikan;
use App\Models\AnakPelamar;
use Illuminate\Http\Request;
use App\Models\KontakDarurat;
use App\Models\KeluargaPelamar;
use App\Models\PengalamanKerja;
use App\Models\KondisiKesehatan;
use App\Models\PenguasaanBahasa;
use App\Models\KemampuanKomputer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\Lowongan;
use App\Models\PelamarLowongan;
use App\Models\PenawaranPelamar;
use App\Models\PengalamanOrganisasi;
use Illuminate\Console\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;
use Monarobase\CountryList\CountryListFacade;

class ProfilController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        if (auth()->check()) {

            $pelamars = User::join('pelamar', 'pelamar.id', 'users.id_pelamar')->where('users.id', auth()->user()->id)->get();

            $countries = CountryListFacade::getList('en');

            $pelamar = Pelamar::find(auth()->user()->id_pelamar);
            $notifikasi_unread = $pelamar->unreadNotifications;
            $notifikasi_read = $pelamar->readNotifications;

            return view('profil.profil_main', [
                // 'users' => User::where('id', auth()->user()->id)->get(),
                'pelamars' => $pelamars,
                'user' => auth()->user(),
                // 'users' => $user,
                'countries' => $countries,
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'pengalamanKerjaExists' => PengalamanKerja::where('id_pelamar', '=', auth()->user()->id_pelamar)->exists(),
                'pengalamanKerja' => PengalamanKerja::where('id_pelamar', '=', auth()->user()->id_pelamar)->orderBy('id', 'asc')->get(),

                'pendidikans' => Pendidikan::where('id_pelamar', '=', auth()->user()->id_pelamar)->orderBy('id_pendidikan', 'asc')->get(),
                'pendidikanExists' => Pendidikan::where('id_pelamar', '=', auth()->user()->id_pelamar)->exists(),

                'referensis' => Referensi::where('id_pelamar', '=', auth()->user()->id_pelamar)->orderBy('id_referensi', 'asc')->get(),
                'referensiExists' => Referensi::where('id_pelamar', '=', auth()->user()->id_pelamar)->exists(),

            ]);
        } else {
            return redirect('/lowongan-kerja')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'nama_pelamar' => 'required',
            'email' => 'nullable',
            'telepon_rumah' => '|numeric|min_digits:11|max_digits:12|',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required',
            'kebangsaan' => 'required'
        ]);

        if ($validatedData) {
            $query = Pelamar::where('id', auth()->user()->id_pelamar)->update($validatedData);
            if ($query) {
                return redirect('/profil-kandidat/users/' . auth()->user()->slug)->with('success', 'Profil Berhasil Diedit');
            }
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function description(Request $request, User $user)
    {
        $rules = [
            'deskripsi' => 'nullable',
        ];

        $validatedData = $request->validate($rules);

        Pelamar::where('id', $user->id_pelamar)->update($validatedData);

        return redirect('/profil-kandidat/users/' . $user->slug)->with('success add description', 'Berhasil mengubah deskripsi');
    }

    public function my_application(User $user)
    {

        if (auth()->check()) {
            $lowonganId = Lowongan::join('pelamar_lowongan', 'pelamar_lowongan.id_lowongan', 'lowongan.id')
                ->join('pelamar', 'pelamar.id', 'pelamar_lowongan.id_pelamar')
                ->join('users', 'users.id_pelamar', 'pelamar.id')
                ->where('users.id_pelamar', auth()->user()->id_pelamar)
                ->get();

            $applicationformId = ApplicationForm::all()->pluck('id_pelamar_lowongan')->toArray();
            $pelamar = Pelamar::find(auth()->user()->id_pelamar);
            $notifikasi_unread = $pelamar->unreadNotifications;
            $notifikasi_read = $pelamar->readNotifications;
            return view('lamaran-saya', [
                'title' => 'Lamaran Saya',
                'user' => auth()->user(),
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'datas' => auth()->user()->pelamar->pelamarLowongan->load([
                    'applicationForm',
                    'pelamar',
                    'lowongan.departemen',
                    'dokumenPelamarLowongan.dokumenPelamar',
                    'statusLamaran.status',
                    'activityLog',
                ]),
                'lowonganId' => $lowonganId,
                'applicationformId' => $applicationformId

            ]);
        } else {
            return redirect('/lowongan-kerja')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function application_form(User $user, Lowongan $lowongan)
    {

        $hobbies = [
            'berenang', 'menyanyi', 'menari', 'bersepeda', 'memahat kayu', 'bermain catur', 'memasak', 'membaca', 'menonton film', 'mendengarkan musik',
            'memainkan biola',
            'berkuda',
            'berbelanja',
            'merajut',
            'melukis',
            'menggambar',
            'membuat puisi',
            'bermain arung jeram',
            'menanjak gunung',
            'memancing',
            'berselancar',
            'bermain seluncur es',
            'fotografi',
            'bermain layang-layang',
            'menyelam',
            'membuat program',
            'menulis cerita',
            'berjalan-jalan',
            'bermain skateboard',
            'berkebun',
            'menjahit',
            'mewarnai',
            'bermain ski',
            'membuat kaligrafi',
            'berlayar'
        ];

        $illness = [
            'heart trouble', 'high blood pressure', 'diabetes', 'asthma', 'nervous disorder', 'back injury', 'skin problem', 'speech', 'sight',
            'hearing', 'heads', 'epilepsy', 'allergy'

        ];

        $computer_skills = [
            'word', 'excel', 'power point', 'internet', 'penggunaan sistem operasi', 'pemrograman',
            'pengembangan web', 'desain grafis', 'animasi', 'editing foto', 'editing video', 'UI/UX Design', 'Manajemen Basis Database'
        ];

        $software = [
            'gmail', 'WordPress',
            'facebook', 'instagram', 'microsoft access', 'NoSQL', 'MySQL', 'SQL', 'MongoDB', 'SANGO Prosfessional', 'adobe photoshop',
            'adobe illustrator', 'adobe premiere pro', 'adobe after effects',
        ];

        $languages = array('Indonesia', 'Inggris', 'Mandarin', 'Prancis', 'Jerman', 'Jepang');

        $countries = CountryListFacade::getList('en');
        $religion = Agama::all();
        $pelamar = Pelamar::find(auth()->user()->id_pelamar);
        $notifikasi_unread = $pelamar->unreadNotifications;
        $notifikasi_read = $pelamar->readNotifications;

        return view('application-forms.application_form', [
            'title' => 'Application Form',
            'countries' => $countries,
            'religions' => $religion,
            'user' => $user,
            'hobbies' => $hobbies,
            'illness' => $illness,
            'computer_skills' => $computer_skills,
            'software' => $software,
            'languages' => $languages,
            'notifikasi_unread' => $notifikasi_unread,
            'notifikasi_read' => $notifikasi_read,
            'datas' => $user->pelamar->pelamarLowongan->load([
                'applicationForm',
                'pelamar.user',
                'pelamar.agama',
                'lowongan.departemen',
            ]),

            'lowongan' => $lowongan,
            'pengalamanKerjaExists' => PengalamanKerja::where('id_pelamar', '=', $user->id_pelamar)->exists(),
            'pengalamanKerja' => PengalamanKerja::where('id_pelamar', '=', $user->id_pelamar)->orderBy('id', 'asc')->get(),

            'pendidikans' => Pendidikan::where('id_pelamar', '=', $user->id_pelamar)->orderBy('id_pendidikan', 'asc')->get(),
            'pendidikanExists' => Pendidikan::where('id_pelamar', '=', $user->id_pelamar)->exists(),

            'referensis' => Referensi::where('id_pelamar', '=', $user->id_pelamar)->orderBy('id_referensi', 'asc')->get(),
            'referensiExists' => Referensi::where('id_pelamar', '=', $user->id_pelamar)->exists(),
        ]);
    }

    public function send_application_form(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'nama_pelamar' => 'required',
            'nik' => 'required',
            'ekspetasi_gaji' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'alamat_tetap' => 'required',
            'telepon_rumah' => 'required|numeric|min_digits:11|max_digits:12|',
            'telepon_kantor' => 'required|numeric|min_digits:11|max_digits:12|',
            'suku' => 'nullable',
            'kebangsaan' => 'required',
            'id_agama' => 'required',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'status_kawin' => 'required',
            'nama_pasangan' => 'nullable',
        ]);
        if ($request->hobi) {
            $hobi = implode(', ', $request->hobi);
            $validatedData['hobi'] = $hobi;
        }
        $formattedCurrency = $request->ekspetasi_gaji; // Example formatted currency string
        $cleanedString = preg_replace('/[^\d]/', '', $formattedCurrency);
        $ekspetasi_gaji = (int) $cleanedString;
        $validatedData['ekspetasi_gaji'] = $ekspetasi_gaji;
        Pelamar::where('id', $user->pelamar->id)->update($validatedData);

        // data anak
        if ($request->counter_row_anak != 0 || $request->counter_row_anak != null) {
            for ($i = 0; $i < (int) $request->counter_row_anak; $i++) {
                AnakPelamar::create([
                    'nama_anak' => $request->nama_anak[$i],
                    'jenis_kelamin_anak' => $request->jenis_kelamin_anak[$i],
                    'umur_anak' => $request->umur_anak[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        //data keluarga
        if ($request->counter_row_keluarga != 0 || $request->counter_row_keluarga != null) { {
                for ($i = 0; $i < (int) $request->counter_row_keluarga; $i++) {
                    KeluargaPelamar::create([
                        'hubungan_keluarga' => $request->hubungan_keluarga[$i],
                        'nama_anggota_keluarga' => $request->nama_anggota_keluarga[$i],
                        'jenis_kelamin_anggota_keluarga' => $request->jenis_kelamin_anggota_keluarga[$i],
                        'umur_anggota_keluarga' => $request->umur_anggota_keluarga[$i],
                        'jenjang_pendidikan_anggota_keluarga' => $request->jenjang_pendidikan_anggota_keluarga[$i],
                        'pekerjaan_anggota_keluarga' => $request->pekerjaan_anggota_keluarga[$i],
                        'perusahaan_tempat_bekerja' => $request->perusahaan_tempat_bekerja[$i],
                        'id_pelamar' => $user->id_pelamar
                    ]);
                }
            }
        }

        //data pengalaman organisasi
        if ($request->counter_row_organisasi != null || $request->counter_row_organisasi != 0) {
            for ($i = 0; $i < (int) $request->counter_row_organisasi; $i++) {
                PengalamanOrganisasi::create([
                    'nama_organisasi' => $request->nama_organisasi[$i],
                    'posisi_di_organisasi' => $request->posisi_di_organisasi[$i],
                    'id_pelamar' => $user->id_pelamar

                ]);
            }
        }

        //data kontak darurat
        if ($request->counter_row_kontak_darurat != null || $request->counter_row_kontak_darurat != 0) {
            for ($i = 0; $i < (int) $request->counter_row_kontak_darurat; $i++) {
                KontakDarurat::create([
                    'nama_kontak' => $request->nama_kontak[$i],
                    'hubungan_kontak' => $request->hubungan_kontak[$i],
                    'telepon_kontak' => $request->telepon_kontak[$i],
                    'alamat_kontak' => $request->alamat_kontak[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        //data riwayat kesehatan
        if ($request->kondisi_kesehatan != null) {
            $kondisi_kesehatan = implode(', ', $request->kondisi_kesehatan);
            $existingId = KondisiKesehatan::where('id_pelamar', $user->id_pelamar)->first();

            if ($existingId) {
                $existingId->update([
                    'kondisi_kesehatan' => $kondisi_kesehatan
                ]);
            } else {
                KondisiKesehatan::create([
                    'kondisi_kesehatan' => $kondisi_kesehatan,
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        if ($request->adakah_penyakit_serius_lainnya != null) {
            $existingId = KondisiKesehatan::where('id_pelamar', $user->id_pelamar)->first();
            if ($existingId) {
                $existingId->update([
                    'adakah_penyakit_serius_lainnya' => $request->adakah_penyakit_serius_lainnya,
                    'nama_penyakit_lainnya' => $request->nama_penyakit_lainnya,
                ]);
            } else {
                KondisiKesehatan::create([
                    'adakah_penyakit_serius_lainnya' => $request->adakah_penyakit_serius_lainnya,
                    'nama_penyakit_lainnya' => $request->nama_penyakit_lainnya,
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        if ($request->apakah_pernah_mengalami_cedera_operasi != null) {
            $existingId = KondisiKesehatan::where('id_pelamar', $user->id_pelamar)->first();

            if ($existingId) {
                KondisiKesehatan::where('id_pelamar', $user->id_pelamar)->update([
                    'apakah_pernah_mengalami_cedera_operasi' => $request->apakah_pernah_mengalami_cedera_operasi,
                    'nama_cedera_atau_operasi' => $request->nama_cedera_atau_operasi,
                ]);
            } else {
                KondisiKesehatan::where('id_pelamar', $user->id_pelamar)->update([
                    'apakah_pernah_mengalami_cedera_operasi' => $request->apakah_pernah_mengalami_cedera_operasi,
                    'nama_cedera_atau_operasi' => $request->nama_cedera_atau_operasi,
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        if ($request->golongan_darah != null) {

            $existingId = KondisiKesehatan::where('id_pelamar', $user->id_pelamar)->first();

            if ($existingId) {

                $existingId->update([
                    'golongan_darah' => $request->golongan_darah,
                ]);
            } else {

                KondisiKesehatan::create([
                    'golongan_darah' => $request->golongan_darah,
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        //data riwayat_pendidikan
        if ($request->counter_row_riwayat_pendidikan != null) {
            for ($i = 0; $i < (int) $request->counter_row_riwayat_pendidikan; $i++) {
                Pendidikan::create([
                    'jenjang_pendidikan' => $request->jenjang_pendidikan[$i],
                    'nama_institusi' => $request->nama_institusi[$i],
                    'jurusan' => $request->jurusan[$i],
                    'tahun_lulus' => $request->tahun_lulus[$i],
                    'ipk' => $request->ipk[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        // data keahlian komputer dan software
        if ($request->nama_kemampuan && $request->software != null) {
            $keahlian_komputer = implode(', ', $request->nama_kemampuan);
            $software = implode(', ', $request->software);
            KemampuanKomputer::create([
                'nama_kemampuan' => $keahlian_komputer,
                'software' => $software,
                'id_pelamar' => $user->id_pelamar
            ]);
        }




        //data penguasaan bahasa
        if ($request->counter_row_penguasaan_bahasa != null) {
            for ($i = 0; $i < (int) $request->counter_row_penguasaan_bahasa; $i++) {
                PenguasaanBahasa::create([
                    'nama_bahasa' => $request->nama_bahasa[$i],
                    'tingkat_penguasaan' => $request->tingkat_penguasaan[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        //data pengalaman kerja
        if ($request->counter_row_riwayat_pekerjaan != null) {
            for ($i = 0; $i < count($request->gaji); $i++) {
                $request_gaji_pengalaman_kerja = $request->gaji; // Example formatted currency string
                $gaji_pengalaman_clear = preg_replace('/[^\d]/', '', $request_gaji_pengalaman_kerja);
                $gaji_pengalaman_clean[] = (int) $gaji_pengalaman_clear[$i];
            }

            for ($i = 0; $i < (int) $request->counter_row_riwayat_pekerjaan; $i++) {
                PengalamanKerja::create([
                    'nama_perusahaan' => $request->nama_perusahaan[$i],
                    'posisi' => $request->posisi[$i],
                    'periode' => $request->periode[$i],
                    'email_instansi' => $request->email_instansi[$i],
                    'telepon' => $request->telepon[$i],
                    'gaji' => $gaji_pengalaman_clean[$i],
                    'alasan_mengundurkan_diri' => $request->alasan_mengundurkan_diri[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }




        //data referensi
        if ($request->counter_row_referensi != null) {
            for ($i = 0; $i < (int) $request->counter_row_referensi + (int) $request->counter_row_referensi_from_satunama; $i++) {
                Referensi::create([
                    'nama_referensi' => $request->nama_referensi[$i],
                    'alamat_referensi' => $request->alamat_referensi[$i],
                    'telepon_referensi' => $request->telepon_referensi[$i],
                    'email_referensi' => $request->email_referensi[$i],
                    'hubungan_referensi' => $request->hubungan_referensi[$i],
                    'posisi_referensi' => $request->posisi_referensi[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        //data pelatihan yang pernah diikuti
        if ($request->counter_row_pelatihan != null) {
            for ($i = 0; $i < (int) $request->counter_row_pelatihan; $i++) {
                Pelatihan::create([
                    'subjek_pelatihan' => $request->subjek_pelatihan[$i],
                    'tahun_pelatihan' => $request->tahun_pelatihan[$i],
                    'nama_mentor' => $request->nama_mentor[$i],
                    'id_pelamar' => $user->id_pelamar
                ]);
            }
        }

        $data_application = [
            'id_pelamar_lowongan' => $request->id_pelamar_lowongan,
            'status_terkirim' => 'true'
        ];

        $query = ApplicationForm::create($data_application);

        if ($query) {
            return redirect('profil-kandidat/users/' . $user->slug . '/lamaran-saya')
                ->with('success send application form', 'Berhasil Mengirim Application Form');
        }
    }

    public function accountSettings(User $user)
    {
        if (auth()->check()) {
            $countries = CountryListFacade::getList('en');
            $pelamar = Pelamar::find(auth()->user()->id_pelamar);
            $notifikasi_unread = $pelamar->unreadNotifications;
            $notifikasi_read = $pelamar->readNotifications;
            return view('pengaturan_akun.pengaturan-akun', [
                'title' => 'Pengaturan Akun',
                'user' => $user,
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'countries' => $countries,
                'datas' => $user->with('pelamar')->where('users.id', $user->id)->get()
            ]);
        } else {
            return redirect('/lowongan-kerja')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function changeAccountSettings(Request $request, User $user)
    {
        if ($request->input('ganti_kata_sandi')) {
            if ($request->input('password') === $request->input('konfirmasi_password_baru')) {
                $data = $request->validate([
                    'password' => 'required|min:5',
                ]);
                $data['password'] = Hash::make($data['password']);
                User::where('users.id', $user->id)->update($data);
                return redirect('/profil-kandidat/users/' . $user->slug . '/pengaturan-akun')->with('success change password', 'Berhasil mengganti password');
            } else {
                return back()->with('failed change password', 'Gagal mengganti password');
            }
        } elseif ($request->input('ganti_email_baru')) {
            $pelamar = $user->load('pelamar');
            if ($request->input('email') != $user->email && $request->input('email') != $pelamar->email) {
                $data = $request->validate([
                    'email' => 'required|email:dns|unique:users,email'
                ]);
                User::where('users.id', $user->id)->update($data);
                Pelamar::where('pelamar.id', $pelamar->pelamar->id)->update($data);
                return redirect('/profil-kandidat/users/' . $user->slug . '/pengaturan-akun')->with('success change email', 'Berhasil mengganti email');
            } else {
                return back()->with('failed change email', 'Gagal mengganti email');
            }
        } elseif ($request->input('ganti_nomor_telepon')) {
            $pelamar = $user->load('pelamar');
            if ($request->input('telepon_rumah') !== $pelamar->telepon_rumah) {
                $data = $request->validate([
                    'telepon_rumah' => 'required|numeric|min_digits:11|max_digits:12|unique:pelamar,telepon_rumah'
                ]);

                Pelamar::where('pelamar.id', $pelamar->pelamar->id)->update($data);
                return redirect('/profil-kandidat/users/' . $user->slug . '/pengaturan-akun')->with('success change phone number', 'Berhasil mengganti nomor telepon');
            } elseif ($request->input('telepon_rumah') === $pelamar->telepon_rumah) {
                return back()->with('failed change phone number', 'Gagal mengganti nomor telepon');
            }
        }
    }

    public function offering(User $user, Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user_ = auth()->user();
            $pelamar_lowongan = $user->join('pelamar', 'pelamar.id', 'users.id_pelamar')
                ->join('pelamar_lowongan', 'pelamar_lowongan.id_pelamar', 'pelamar.id')
                ->join('lowongan', 'pelamar_lowongan.id_lowongan', 'lowongan.id')
                ->where('lowongan.id', $lowongan->id)
                ->where('users.id', $user_->id)
                ->get();

            $data_penawaran = PenawaranPelamar::where('id_pelamar_lowongan', $pelamar_lowongan[0]->id_pelamar_lowongan)->get();

            $pelamar = Pelamar::find(auth()->user()->id_pelamar);
            $notifikasi_unread = $pelamar->unreadNotifications;
            $notifikasi_read = $pelamar->readNotifications;
            $penawaran_pelamar_id = DB::table('penawaran_pelamar')->select(['*'])->pluck('id_pelamar_lowongan')->toArray();

            return view('penawaran-pelamar', [
                'title' => 'Penawaran',
                'user' => auth()->user(),
                'lowongan' => $lowongan,
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'datas' => auth()->user()->pelamar->pelamarLowongan->load([
                    'applicationForm',
                    'pelamar',
                    'lowongan.departemen',
                    'dokumenPelamarLowongan.dokumenPelamar',
                    'statusLamaran.status',
                    'activityLog',
                ]),
                'penawaran_pelamar_id' => $penawaran_pelamar_id,
                'data_penawaran' => $data_penawaran
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }
}
