<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agama;
use App\Models\Pelamar;
use App\Models\Lowongan;
use App\Models\Referensi;
use App\Models\Pendidikan;
use App\Models\AnakPelamar;
use Illuminate\Http\Request;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\Auth;
use Monarobase\CountryList\CountryListFacade;
use PDO;

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
            'nama_anak.*' => 'required',
            'jenis_kelamin_anak.*' => 'required',
            'umur_anak.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
                'pengembangan web', 'desain grafis', 'animasi', 'editing foto', 'editing video', 'UI/UX Design', 'Manajemen Basis Database'
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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
            // 'hubungan_keluarga' => 'required',
            // 'nama_anggota_keluarga.*' => 'required',
            // 'jenis_kelamin_anggota_keluarga' => 'required',
            // 'umur_anggota_keluarga.*' => 'required',
            // 'jenjang_pendidikan_anggota_keluarga' => 'required',
            // 'pekerjaan_anggota_keluarga.*' => 'required',
            // 'perusahaan_tempat_bekerja.*' => 'required',
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

    public function storeAllStep(Request $request, Lowongan $lowongan)
    {

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
            $key11Data
        );

        dd($mergedData);
    }
}
