<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\LowonganKerjaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\ControllerAuthSSO;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\PengalamanKerjaController;
use App\Http\Controllers\ReferensiController;

use App\Models\Lowongan;
use App\Models\TesTertulis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/lowongan-kerja', [LowonganKerjaController::class, 'index']);
Route::post('/lowongan-kerja/{lowongan}', [LowonganKerjaController::class, 'apply']);
Route::get('/lowongan-kerja/{lowongan:slug}/detail', [LowonganKerjaController::class, 'show']);

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/sso-auth', [ControllerAuthSSO::class, 'sso_auth'])->name('sso-auth');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/register/createSlug', [RegisterController::class, 'checkSlug']);

Route::get('/markasread-notification-admin/{id}', [AdminDashboardController::class, 'markasread']);
Route::get('/markasread/{id}', [LowonganKerjaController::class, 'markAsRead']);

Route::post('/profil-kandidat/users/{user:uuid}/description', [ProfilController::class, 'description']);
Route::get('/lamaran-saya/{user:uuid}', [ProfilController::class, 'my_application']);
Route::get('/pengaturan-akun/{user:uuid}', [ProfilController::class, 'accountSettings']);
Route::get('/profil-kandidat/users/{user:slug}/offering/{lowongan}', [ProfilController::class, 'offering']);
Route::post('/profil-kandidat/users/{user:slug}/changeAccountSettings', [ProfilController::class, 'changeAccountSettings']);

Route::get('/{lowongan}/application-form', [ApplicationFormController::class, 'step1'])->name('application-form.tambah-data-pribadi');
Route::post('/{lowongan}/application-form/data-pribadi', [ApplicationFormController::class, 'storeStep1']);
Route::get('/{lowongan}/application-form/data-anak', [ApplicationFormController::class, 'step2'])->name('application-forms.tambah-anak');
Route::post('/{lowongan}/application-form/data-anak', [ApplicationFormController::class, 'storeStep2']);
Route::get('/{lowongan}/application-form/data-keluarga', [ApplicationFormController::class, 'step3'])->name('application-forms.tambah-data-keluarga');
Route::post('/{lowongan}/application-form/data-keluarga', [ApplicationFormController::class, 'storeStep3']);
Route::get('/{lowongan}/application-form/data-pengalaman-organisasi', [ApplicationFormController::class, 'step4'])->name('application-forms.tambah-data-pengalaman-organisasi');
Route::post('/{lowongan}/application-form/data-pengalaman-organisasi', [ApplicationFormController::class, 'storeStep4']);
Route::get('/{lowongan}/application-form/data-kontak-darurat', [ApplicationFormController::class, 'step5'])->name('application-forms.tambah-data-kontak-darurat');
Route::post('/{lowongan}/application-form/data-kontak-darurat', [ApplicationFormController::class, 'storeStep5']);
Route::get('/{lowongan}/application-form/data-kondisi-kesehatan', [ApplicationFormController::class, 'step6'])->name('application-forms.tambah-data-kondisi-kesehatan');
Route::post('/{lowongan}/application-form/data-kondisi-kesehatan', [ApplicationFormController::class, 'storeStep6']);
Route::get('/{lowongan}/application-form/data-riwayat-pendidikan', [ApplicationFormController::class, 'step7'])->name('application-forms.tambah-data-riwayat-pendidikan');
Route::post('/{lowongan}/application-form/data-riwayat-pendidikan', [ApplicationFormController::class, 'storeStep7']);
Route::get('/{lowongan}/application-form/data-keahlian-komputer', [ApplicationFormController::class, 'step8'])->name('application-forms.tambah-data-keahlian-komputer');
Route::post('/{lowongan}/application-form/data-keahlian-komputer', [ApplicationFormController::class, 'storeStep8']);
Route::get('/{lowongan}/application-form/data-penguasaan-bahasa', [ApplicationFormController::class, 'step9'])->name('application-forms.tambah-data-penguasaan-bahasa');
Route::post('/{lowongan}/application-form/data-penguasaan-bahasa', [ApplicationFormController::class, 'storeStep9']);
Route::get('/{lowongan}/application-form/data-pengalaman-kerja', [ApplicationFormController::class, 'step10'])->name('application-forms.tambah-data-pengalaman-kerja');
Route::post('/{lowongan}/application-form/data-pengalaman-kerja', [ApplicationFormController::class, 'storeStep10']);
Route::get('/{lowongan}/application-form/data-referensi', [ApplicationFormController::class, 'step11'])->name('application-forms.tambah-data-referensi');
Route::post('/{lowongan}/application-form/data-referensi', [ApplicationFormController::class, 'storeStep11']);
Route::get('/{lowongan}/application-form/data-pelatihan-yang-diikuti', [ApplicationFormController::class, 'step12'])->name('application-forms.tambah-data-pelatihan-yang-diikuti');
Route::post('/{lowongan}/application-form/data-pelatihan-yang-diikuti', [ApplicationFormController::class, 'storeAllStep']);

Route::resource('/profil-kandidat/users', ProfilController::class);
Route::resource('/pengalamanKerja', PengalamanKerjaController::class);

Route::resource('/pendidikan', PendidikanController::class);

Route::resource('/referensi', ReferensiController::class);

Route::middleware('authlogin')->group(function () {
    Route::put('/admin-dashboard/tesTertulis/edit-schedule/{tesTertulis}', [AdminDashboardController::class, 'editScheduleTest']);
    Route::get('/admin-dashboard/lowongan/createSlug', [AdminDashboardController::class, 'checkSlug']);
    Route::post('/admin-dashboard/lowongan/{lowongan:slug}/closeJobs', [AdminDashboardController::class, 'closeJobs']);
    Route::post('/admin-dashboard/lowongan/{lowongan:slug}/activatedJob', [AdminDashboardController::class, 'activatedJob']);
    Route::get('/admin-dashboard/lowongan/{lowongan:slug}/kelola-kandidat', [AdminDashboardController::class, 'show']);
    Route::get('/admin-dashboard/lowongan/{lowongan}/detail-pelamar/beban-kerja/{user}', [AdminDashboardController::class, 'workLoad']);
    Route::post('/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{user}', [AdminDashboardController::class, 'sendOffering']);

    Route::get('/admin-dashboard/lowongan/{lowongan:slug}/instrumen-penilaian-beban-kerja/{user}', [AdminDashboardController::class, 'instrumenAnalisaBebanKerja']);

    Route::post('/admin-dashboard/lowongan/{lowongan:slug}/instrumen-analisis-beban-kerja/{user}', [AdminDashboardController::class, 'instrumentAnalysis']);

    Route::get('/admin-dashboard/lowongan/{lowongan:slug}/detail-pelamar/{user}', [AdminDashboardController::class, 'detailCandidate']);
    Route::get('/admin-dashboard/lowongan/{lowongan:slug}/detail-pelamar/{user}/application-form', [AdminDashboardController::class, 'viewApplicationForms']);
    Route::post('/admin-dashboard/lowongan/{statusLamaran}/changePosition', [AdminDashboardController::class, 'changePosition']);
    Route::get('/admin-dashboard/lowongan/{pelamarLowongan}/assesment', [AdminDashboardController::class, 'assesment']);
    Route::post('/admin-dashboard/lowongan/addScheduleTest', [AdminDashboardController::class, 'addScheduleTest']);
    Route::post('/admin-dashboard/lowongan/{lowongan:slug}/detail-pelamar/reference-check', [AdminDashboardController::class, 'referenceCheck']);
    Route::resource('/admin-dashboard/lowongan', AdminDashboardController::class);
});


