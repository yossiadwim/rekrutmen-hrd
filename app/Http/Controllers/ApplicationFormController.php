<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agama;
use App\Models\Pelamar;
use App\Models\Lowongan;
use App\Models\Pelatihan;
use App\Models\Referensi;
use App\Models\Pendidikan;
use App\Models\AnakPelamar;
use Illuminate\Http\Request;
use App\Models\KontakDarurat;
use App\Models\ApplicationForm;
use App\Models\KeluargaPelamar;
use App\Models\PengalamanKerja;
use App\Models\KondisiKesehatan;
use App\Models\PenguasaanBahasa;
use App\Models\KemampuanKomputer;
use Illuminate\Support\Facades\DB;
use App\Models\PengalamanOrganisasi;
use Monarobase\CountryList\CountryListFacade;

class ApplicationFormController extends Controller
{
    public function step1(Lowongan $lowongan, User $user)
    {

        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;

            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
                $countries = CountryListFacade::getList('en');
                $religion = Agama::all();

                return view('application-forms.application_form', [
                    'title' => 'Application Form',
                    'notifikasi_read' => $notifikasi_read,
                    'notifikasi_unread' => $notifikasi_unread,
                    'user' => $user,
                    'lowongan' => $lowongan,
                    'countries' => $countries,
                    'religions' => $religion,
                    'datas' => $user->pelamar->pelamarLowongan->load([
                        'applicationForm',
                        'pelamar.user',
                        'pelamar.agama',
                        'lowongan.departemen',
                    ]),
                ]);
            }
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep1(Request $request)
    {
        $validatedData = $request->validate([
            'id_pelamar_lowongan' => 'nullable',
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
            'hobi' => 'required'
        ]);

        if ($request->hobi) {
            $hobi = implode(', ', $request->hobi);
            $validatedData['hobi'] = $hobi;
        }

        session()->put('applicationFormDataStep1', $validatedData);

        $lowongan = Lowongan::where('slug', $request->slug_lowongan)->get();

        return redirect('/' . $lowongan[0]->slug . '/application-form/data-anak');
    }

    public function step2(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.tambah-anak', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep2(Request $request, Lowongan $lowongan)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_anak.*' => 'nullable',
            'jenis_kelamin_anak.*' => 'nullable',
            'umur_anak.*' => 'nullable',
            'counter_row_anak' => 'nullable'
        ]);

        session()->put('applicationFormDataStep2', $validatedData);

        return redirect()->route('application-forms.tambah-data-keluarga', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step3(Lowongan $lowongan)
    {

        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.tambah-anggota-keluarga', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep3(Request $request, Lowongan $lowongan)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'hubungan_keluarga.*' => 'required',
            'nama_anggota_keluarga.*' => 'required',
            'jenis_kelamin_anggota_keluarga' => 'required',
            'umur_anggota_keluarga.*' => 'required',
            'jenjang_pendidikan_anggota_keluarga' => 'required',
            'pekerjaan_anggota_keluarga.*' => 'required',
            'perusahaan_tempat_bekerja.*' => 'required',
            'counter_row_keluarga' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep3', $validatedData);

        return redirect()->route('application-forms.tambah-data-pengalaman-organisasi', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step4(Lowongan $lowongan)
    {

        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.tambah-organisasi', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep4(Request $request, Lowongan $lowongan)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_organisasi' => 'nullable',
            'posisi_di_organisasi' => 'nullable',
            'counter_row_organisasi' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep4', $validatedData);

        return redirect()->route('application-forms.tambah-data-kontak-darurat', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step5(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.kontak_darurat', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep5(Request $request, Lowongan $lowongan)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_kontak.*' => 'required|string',
            'hubungan_kontak.*' => 'required',
            'telepon_kontak.*' => 'required|numeric|min_digits:11|max_digits:12',
            'alamat_kontak.*' => 'required',
            'counter_row_kontak_darurat' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep5', $validatedData);

        return redirect()->route('application-forms.tambah-data-kondisi-kesehatan', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step6(Lowongan $lowongan)
    {

        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            $illness = [
                'heart trouble', 'high blood pressure', 'diabetes', 'asthma', 'nervous disorder', 'back injury', 'skin problem', 'speech', 'sight',
                'hearing', 'heads', 'epilepsy', 'allergy'

            ];
            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.kesehatan', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'illness' => $illness,
                'user' => $user,
                'lowongan' => $lowongan,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep6(Request $request, Lowongan $lowongan)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'kondisi_kesehatan.*' => 'string|nullable',
            'adakah_penyakit_serius_lainnya' => 'string|nullable',
            'nama_penyakit_lainnya' => 'string|nullable',
            'apakah_pernah_mengalami_cedera_operasi' => 'string|nullable',
            'nama_cedera_atau_operasi' => 'string|nullable',
            'golongan_darah' => 'string|nullable',
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep6', $validatedData);

        return redirect()->route('application-forms.tambah-data-riwayat-pendidikan', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step7(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;

            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.riwayat_pendidikan', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
                'pendidikans' => Pendidikan::where('id_pelamar', '=', auth()->user()->id_pelamar)->orderBy('id_pendidikan', 'asc')->get(),
                'pendidikanExists' => Pendidikan::where('id_pelamar', '=', auth()->user()->id_pelamar)->exists(),
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep7(Request $request, Lowongan $lowongan)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'jenjang_pendidikan.*' => 'required',
            'jurusan.*' => 'nullable',
            'ipk.*' => 'nullable',
            'nama_institusi.*' => 'required',
            'tahun_lulus.*' => 'required',
            'counter_row_riwayat_pendidikan' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep7', $validatedData);

        return redirect()->route('application-forms.tambah-data-keahlian-komputer', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step8(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            $computer_skills = [
                'word', 'excel', 'power point', 'internet', 'penggunaan sistem operasi', 'pemrograman',
                'pengembangan web', 'desain grafis', 'animasi', 'editing foto', 'editing video', 'UI/UX Design', 'Manajemen Basis Data'
            ];

            $software = [
                'gmail', 'WordPress',
                'facebook', 'instagram', 'microsoft access', 'NoSQL', 'MySQL', 'SQL', 'MongoDB', 'SANGO Prosfessional', 'adobe photoshop',
                'adobe illustrator', 'adobe premiere pro', 'adobe after effects',
            ];

            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }


            return view('application-forms.keahlian_komputer', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
                'computer_skills' => $computer_skills,
                'software' => $software,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep8(Request $request, Lowongan $lowongan)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_kemampuan.*' => 'nullable',
            'software.*' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep8', $validatedData);

        return redirect()->route('application-forms.tambah-data-penguasaan-bahasa', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step9(Lowongan $lowongan)
    {

        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;
            $languages = array('Indonesia', 'Inggris', 'Mandarin', 'Prancis', 'Jerman', 'Jepang');


            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.penguasaan_bahasa', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
                'languages' => $languages,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep9(Request $request, Lowongan $lowongan)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_bahasa.*' => 'required',
            'tingkat_penguasaan.*' => 'required',
            'counter_row_penguasaan_bahasa' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep9', $validatedData);

        return redirect()->route('application-forms.tambah-data-pengalaman-kerja', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step10(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;


            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.riwayat_pekerjaan', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
                'pengalamanKerjaExists' => PengalamanKerja::where('id_pelamar', '=', $user->id_pelamar)->exists(),
                'pengalamanKerja' => PengalamanKerja::where('id_pelamar', '=', $user->id_pelamar)->orderBy('id', 'asc')->get(),

            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep10(Request $request, Lowongan $lowongan)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_perusahaan.*' => 'nullable',
            'email_instansi.*' => 'nullable',
            'posisi.*' => 'required',
            'periode.*' => 'required',
            'gaji.*' => 'nullable',
            'alasan_mengundurkan_diri.*' => 'nullable',
            'id_pelamar.*' => 'required',
            'telepon.*' => 'nullable|numeric|min_digits:11|max_digits:12|unique:pengalaman_kerja,telepon',
            'counter_row_riwayat_pekerjaan' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep10', $validatedData);

        return redirect()->route('application-forms.tambah-data-referensi', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step11(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;


            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.referensis', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
                'referensis' => Referensi::where('id_pelamar', '=', $user->id_pelamar)->orderBy('id_referensi', 'asc')->get(),
                'referensiExists' => Referensi::where('id_pelamar', '=', $user->id_pelamar)->exists(),
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeStep11(Request $request, Lowongan $lowongan)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'nama_referensi.*' => 'nullable',
            'alamat_referensi.*' => 'nullable',
            'telepon_referensi.*' => 'nullable',
            'email_referensi.*' => 'nullable',
            'hubungan_referensi.*' => 'nullable',
            'posisi_referensi.*' => 'nullable',
            'id_pelamar.*' => 'required',
            'counter_row_referensi' => 'nullable',
            'counter_row_referensi_from_satunama' => 'nullable'
        ]);

        $validatedData['id_pelamar'] = $user->id_pelamar;

        session()->put('applicationFormDataStep11', $validatedData);

        return redirect()->route('application-forms.tambah-data-pelatihan-yang-diikuti', [
            'user' => $user,
            'lowongan' => $lowongan
        ]);
    }

    public function step12(Lowongan $lowongan)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $notifikasi_read = null;
            $notifikasi_unread = null;

            if ($user) {
                $pelamar = Pelamar::find(auth()->user()->id_pelamar);
                $notifikasi_unread = $pelamar->unreadNotifications;
                $notifikasi_read = $pelamar->readNotifications;
            }

            return view('application-forms.pelatihan_form', [
                'title' => 'Application Form',
                'notifikasi_unread' => $notifikasi_unread,
                'notifikasi_read' => $notifikasi_read,
                'user' => $user,
                'lowongan' => $lowongan,
            ]);
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }

    public function storeAllStep(Request $request)
    {

        if (auth()->check()) {
            $user = auth()->user();
            $validatedData = $request->validate([
                'subjek_pelatihan.*' => 'nullable',
                'tahun_pelatihan.*' => 'nullable',
                'nama_mentor.*' => 'nullable',
                'counter_row_pelatihan' => 'nullable',
            ]);

            $validatedData['id_pelamar'] = $user->id_pelamar;

            session()->put('applicationFormDataStep12', $validatedData);

            $key1Data = session('applicationFormDataStep1', []);
            $key2Data = session('applicationFormDataStep2', []);
            $key3Data = session('applicationFormDataStep3', []);
            $key4Data = session('applicationFormDataStep4', []);
            $key5Data = session('applicationFormDataStep5', []);
            $key6Data = session('applicationFormDataStep6', []);
            $key7Data = session('applicationFormDataStep7', []);
            $key8Data = session('applicationFormDataStep8', []);
            $key9Data = session('applicationFormDataStep9', []);
            $key10Data = session('applicationFormDataStep10', []);
            $key11Data = session('applicationFormDataStep11', []);
            $key12Data = session('applicationFormDataStep12', []);
            $mergedData = array_merge(
                $key1Data,
                $key2Data,
                $key3Data,
                $key4Data,
                $key5Data,
                $key6Data,
                $key7Data,
                $key8Data,
                $key9Data,
                $key10Data,
                $key11Data,
                $key12Data
            );

            // dd($mergedData);

            try {
                DB::beginTransaction();

                //pelamar table update
                $dataPelamar = [
                    'nama_pelamar' => $mergedData['nama_pelamar'],
                    'nik' => $mergedData['nik'],
                    'jenis_kelamin' => $mergedData['jenis_kelamin'],
                    'tempat_lahir' => $mergedData['tempat_lahir'],
                    'tanggal_lahir' => $mergedData['tanggal_lahir'],
                    'alamat' => $mergedData['alamat'],
                    'alamat_tetap' => $mergedData['alamat_tetap'],
                    'telepon_rumah' => $mergedData['telepon_rumah'],
                    'telepon_kantor' => $mergedData['telepon_kantor'],
                    'suku' => $mergedData['suku'],
                    'kebangsaan' => $mergedData['kebangsaan'],
                    'id_agama' => $mergedData['id_agama'],
                    'tinggi_badan' => $mergedData['tinggi_badan'],
                    'berat_badan' => $mergedData['berat_badan'],
                    'status_kawin' => $mergedData['status_kawin'],
                    'nama_pasangan' => $mergedData['nama_pasangan'],
                ];
                $formattedCurrency = $mergedData['ekspetasi_gaji']; // Example formatted currency string
                $cleanedString = preg_replace('/[^\d]/', '', $formattedCurrency);
                $ekspetasi_gaji = (int) $cleanedString;
                $dataPelamar['ekspetasi_gaji'] = $ekspetasi_gaji;

                $hobi = explode(',', $mergedData['hobi']);
                $hobi = array_map('trim', $hobi);
                $hobbi = implode(',', $hobi);
                $dataPelamar['hobi'] = strtolower($hobbi);

                Pelamar::where('id', $mergedData['id_pelamar'])->update($dataPelamar);

                if ((int)$mergedData['counter_row_anak'] != 0) {

                    $existingAnakPelamar = AnakPelamar::where('id_pelamar', $user->id_pelamar)->first();

                    for ($i = 0; $i < (int) $mergedData['counter_row_anak']; $i++) {
                        $dataAnak = [
                            'nama_anak' => $mergedData['nama_anak'][$i],
                            'jenis_kelamin_anak' => $mergedData['jenis_kelamin_anak'][$i],
                            'umur_anak' => $mergedData['umur_anak'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']
                        ];

                        if ($existingAnakPelamar) {
                            $existingAnakPelamar->update($dataAnak);
                        } else {
                            AnakPelamar::create($dataAnak);
                        }
                    }
                }

                if ((int) $mergedData['counter_row_keluarga'] != 0) {

                    $existingDataKeluarga = KeluargaPelamar::where('id_pelamar', $user->id_pelamar)->first();

                    for ($i = 0; $i < (int) $mergedData['counter_row_keluarga']; $i++) {
                        $dataKeluarga = [
                            'hubungan_keluarga' => $mergedData['hubungan_keluarga'][$i],
                            'nama_anggota_keluarga' => $mergedData['nama_anggota_keluarga'][$i],
                            'jenis_kelamin_anggota_keluarga' => $mergedData['jenis_kelamin_anggota_keluarga'][$i],
                            'umur_anggota_keluarga' => $mergedData['umur_anggota_keluarga'][$i],
                            'jenjang_pendidikan_anggota_keluarga' => $mergedData['jenjang_pendidikan_anggota_keluarga'][$i],
                            'pekerjaan_anggota_keluarga' => $mergedData['pekerjaan_anggota_keluarga'][$i],
                            'perusahaan_tempat_bekerja' => $mergedData['perusahaan_tempat_bekerja'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']
                        ];

                        if ($existingDataKeluarga) {
                            $existingDataKeluarga->update($dataKeluarga);
                        } else {
                            KeluargaPelamar::create($dataKeluarga);
                        }
                    }
                }

                if ((int)$mergedData['counter_row_organisasi'] != 0) {

                    $existingDataOrganisasi = PengalamanOrganisasi::where('id_pelamar', $user->id_pelamar)->first();

                    for ($i = 0; $i < (int) $mergedData['counter_row_organisasi']; $i++) {

                        $dataOrganisasi = [
                            'nama_organisasi' => $mergedData['nama_organisasi'][$i],
                            'posisi_di_organisasi' => $mergedData['posisi_di_organisasi'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']
                        ];

                        if ($existingDataOrganisasi) {
                            $existingDataOrganisasi->update($dataOrganisasi);
                        } else {
                            PengalamanOrganisasi::create($dataOrganisasi);
                        }
                    }
                }

                if ((int)$mergedData['counter_row_kontak_darurat'] != 0) {

                    $existingDataKontakDarurat = KontakDarurat::where('id_pelamar', $user->id_pelamar)->first();

                    for ($i = 0; $i < (int) $mergedData['counter_row_kontak_darurat']; $i++) {
                        $dataKontakDarurat = [
                            'nama_kontak' => $mergedData['nama_kontak'][$i],
                            'hubungan_kontak' => $mergedData['hubungan_kontak'][$i],
                            'telepon_kontak' => $mergedData['telepon_kontak'][$i],
                            'alamat_kontak' => $mergedData['alamat_kontak'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']

                        ];

                        if ($existingDataKontakDarurat) {
                            $existingDataKontakDarurat->update($dataKontakDarurat);
                        } else {
                            KontakDarurat::create($dataKontakDarurat);
                        }
                    }
                }


                $string_kondisi_kesehatan = implode(', ', $mergedData['kondisi_kesehatan']);
                $string_trim_penyakit_lainnya = array_map('trim', explode(',', $mergedData['nama_penyakit_lainnya']));
                $string_trim_nama_cedera_atau_operasi = array_map('trim', explode(',', $mergedData['nama_cedera_atau_operasi']));

                $string_penyakit_lainnya = implode(', ', $string_trim_penyakit_lainnya);
                $string_nama_cedera_operasi = implode(', ', $string_trim_nama_cedera_atau_operasi);

                $data_kondisi_kesehatan = [
                    'kondisi_kesehatan' => $string_kondisi_kesehatan,
                    'adakah_penyakit_serius_lainnya' => $mergedData['adakah_penyakit_serius_lainnya'],
                    'nama_penyakit_lainnya' => $string_penyakit_lainnya,
                    'apakah_pernah_mengalami_cedera_operasi' => $mergedData['apakah_pernah_mengalami_cedera_operasi'],
                    'nama_cedera_atau_operasi' => $string_nama_cedera_operasi,
                    'golongan_darah' => $mergedData['golongan_darah'],
                    'id_pelamar' => $mergedData['id_pelamar'],
                ];

                KondisiKesehatan::create($data_kondisi_kesehatan);


                if ((int) $mergedData['counter_row_riwayat_pendidikan'] != 0) {

                    $existingPendidikan = Pendidikan::where('id_pelamar', $user->id_pelamar)->first();

                    for ($i = 0; $i < (int) $mergedData['counter_row_riwayat_pendidikan']; $i++) {
                        $data_pendidikan = [
                            'jenjang_pendidikan' => $mergedData['jenjang_pendidikan'][$i],
                            'nama_institusi' => $mergedData['nama_institusi'][$i],
                            'tahun_lulus' => $mergedData['tahun_lulus'][$i],
                            'ipk' => $mergedData['ipk'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']
                        ];
                        Pendidikan::create($data_pendidikan);
                    }
                }


                $string_nama_kemampuan_komputer = implode(', ', $mergedData['nama_kemampuan']);
                $string_software = implode(', ', $mergedData['software']);
                $data_kemampuan_komputer = [
                    'nama_kemampuan' => $string_nama_kemampuan_komputer,
                    'software' => $string_software,
                    'id_pelamar' => $mergedData['id_pelamar']
                ];

                KemampuanKomputer::create($data_kemampuan_komputer);

                if ((int) $mergedData['counter_row_penguasaan_bahasa'] != 0) {
                    for ($i = 0; $i < (int) $mergedData['counter_row_penguasaan_bahasa']; $i++) {
                        $data_penguasaan_bahasa = [
                            'nama_bahasa' => $mergedData['nama_bahasa'][$i],
                            'tingkat_penguasaan' => $mergedData['tingkat_penguasaan'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']
                        ];

                        PenguasaanBahasa::create($data_penguasaan_bahasa);
                    }
                }

                if ((int) $mergedData['counter_row_riwayat_pekerjaan'] != 0) {

                    $existingPengalamanKerja = PengalamanKerja::where('id_pelamar', $user->id_pelamar);

                    for ($i = 0; $i < (int) $mergedData['counter_row_riwayat_pekerjaan']; $i++) {

                        $request_gaji_pengalaman_kerja = $mergedData['gaji']; // Example formatted currency string
                        $gaji_pengalaman_clear = preg_replace('/[^\d]/', '', $request_gaji_pengalaman_kerja);
                        $gaji_pengalaman_clean[] = (int) $gaji_pengalaman_clear[$i];

                        $data_pengalaman_kerja = [
                            'nama_perusahaan' => $mergedData['nama_perusahaan'][$i],
                            'email_instansi' => $mergedData['email_instansi'][$i],
                            'posisi' => $mergedData['posisi'][$i],
                            'periode' => $mergedData['periode'][$i],
                            'gaji' => $gaji_pengalaman_clean[$i],
                            'alasan_mengundurkan_diri' => $mergedData['alasan_mengundurkan_diri'][$i],
                            'telepon' => $mergedData['telepon'][$i],
                            'id_pelamar' => $mergedData['id_pelamar'],
                        ];
                        PengalamanKerja::create($data_pengalaman_kerja);
                    }
                }



                if ((int) $mergedData['counter_row_referensi'] + (int) $mergedData['counter_row_referensi_from_satunama'] != 0) {
                    $existingReferensi = Referensi::where('id_pelamar', $user->id_pelamar)->first();

                    for ($i = 0; $i < (int) $mergedData['counter_row_referensi'] + (int) $mergedData['counter_row_referensi_from_satunama']; $i++) {
                        $data_referensi = [
                            'nama_referensi' => $mergedData['nama_referensi'][$i],
                            'alamat_referensi' => $mergedData['alamat_referensi'][$i],
                            'telepon_referensi' => $mergedData['telepon_referensi'][$i],
                            'email_referensi' => $mergedData['email_referensi'][$i],
                            'hubungan_referensi' => $mergedData['hubungan_referensi'][$i],
                            'posisi_referensi' => $mergedData['posisi_referensi'][$i],
                            'id_pelamar' => $mergedData['id_pelamar'],
                        ];
                        Referensi::create($data_referensi);
                    }
                }

                if ((int) $mergedData['counter_row_pelatihan'] != 0) {
                    for ($i = 0; $i < (int) $mergedData['counter_row_pelatihan']; $i++) {
                        $data_pelatihan = [
                            'subjek_pelatihan' => $mergedData['subjek_pelatihan'][$i],
                            'tahun_pelatihan' => $mergedData['tahun_pelatihan'][$i],
                            'nama_mentor' => $mergedData['nama_mentor'][$i],
                            'id_pelamar' => $mergedData['id_pelamar']
                        ];

                        Pelatihan::create($data_pelatihan);
                    }
                }

                $data_application = [
                    'id_pelamar_lowongan' => $mergedData['id_pelamar_lowongan'],
                    'status_terkirim' => 'true'
                ];

                ApplicationForm::create($data_application);

                DB::commit();

                return redirect('/lamaran-saya/' . $user->uuid)->with('success send application form', 'Berhasil Mengirim Application Form');
            } catch (\Exception $e) {
                DB::rollBack();

                echo  $e->getMessage();
            }
        } else {
            return redirect('/login')->with('session timeout', 'Session Anda sudah kedaluwarsa. Silahkan Login kembali');
        }
    }
}
