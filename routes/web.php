<?php

use App\Http\Controllers\Admin\AdminKelahiranController;
use App\Http\Controllers\Admin\AdminKematianController;
use App\Http\Controllers\Admin\DataPersyaratanController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Penduduk\KelahiranController;
use App\Http\Controllers\Penduduk\KematianController;
use App\Http\Controllers\ProfileController;
use App\Models\Birth;
use App\Models\DataPersyaratan;
use App\Models\Death;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('landingpage.welcome',[DataPersyaratanController::class, 'index']);
// });

Route::get('/', [DataPersyaratanController::class,'landingPage']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('register-penduduk', [AuthController::class, 'showPendudukRegisterForm'])->name('register.penduduk');
Route::post('register-penduduk/create', [AuthController::class, 'pendudukRegister'])->name('penduduk.store');

Route::get('login-admin', [AuthController::class, 'showAdminLoginForm'])->name('login.admin');
Route::post('login-admin', [AuthController::class, 'adminLogin']);

Route::get('login-penduduk', [AuthController::class, 'showPendudukLoginForm'])->name('login.penduduk');
Route::post('login-penduduk', [AuthController::class, 'pendudukLogin']);

// Logout route
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admindashboard'); // Route untuk admin
        } elseif ($user->hasRole('penduduk')) {
            return redirect()->route('pendudukdashboard'); // Route untuk penduduk
        }

        // Redirect default jika role tidak dikenali
        return redirect()->route('login'); // Sesuaikan dengan route default Anda
    })->name('dashboard');

    // Admin
    Route::middleware('role:admin')->group(function() {

        Route::get('/admindashboard', function () {
            $totalKelahiranAdm = Birth::count(); // Calculate total birth requests
            $totalKematianAdm = Death::count(); // Calculate total death requests

            return view('admin.dashboard', compact('totalKelahiranAdm', 'totalKematianAdm'));
        })->name('admindashboard');

        Route::resource('kelahiranadmin', AdminKelahiranController::class);
        Route::post('/kelahiranadmin/{id}/verify', [AdminKelahiranController::class, 'verify'])->name('kelahiranadmin.verify');
        Route::post('/kelahiran/cancelVerify/{id}', [AdminKelahiranController::class, 'cancelVerify'])->name('kelahiranadmin.cancelVerify');
        Route::get('/kelahiran/admin/download/{id}', [AdminKelahiranController::class, 'downloadPdf'])->name('kelahiranadmin.downloadPdf');

        Route::resource('kematianadmin', AdminKematianController::class);
        Route::post('/kematianadmin/{id}/verify', [AdminKematianController::class, 'verify'])->name('kematianadmin.verify');
        Route::post('/kematian/cancelVerify/{id}', [AdminKematianController::class, 'cancelVerify'])->name('kematianadmin.cancelVerify');
        Route::get('/kematian/admin/download/{id}', [AdminKematianController::class, 'downloadPdf' ])->name('kematianadmin.downloadPdf');

        Route::get('/datapersyaratan', [DataPersyaratanController::class, 'index'])->name('datapersyaratan.index');
        Route::get('/datapersyaratan/create', [DataPersyaratanController::class, 'create'])->name('datapersyaratan.create');
        Route::post('/datapersyaratan', [DataPersyaratanController::class, 'store'])->name('datapersyaratan.store');
        Route::get('/datapersyaratan/{datapersyaratan}/edit', [DataPersyaratanController::class, 'edit'])->name('datapersyaratan.edit');
        Route::put('/datapersyaratan/{datapersyaratan}', [DataPersyaratanController::class, 'update'])->name('datapersyaratan.update');
        Route::delete('/datapersyaratan/{datapersyaratan}', [DataPersyaratanController::class, 'destroy'])->name('datapersyaratan.destroy');

        Route::resource('daftaruser', ManajemenUserController::class)->parameters(['daftaruser' => 'user']);
        Route::get('/users/filter', [ManajemenUserController::class, 'filterRole'])->name('daftaruser.filter');
        // Route::post('/daftaruser/create', [ManajemenUserController::class, 'create'])->name('admin.manajemenuser.create');
        // Route::post('/daftaruser/create', [ManajemenUserController::class, 'create'])->name('admin.manajemenuser.create');
        // Route::get('/daftaruser/{user}/edit',  [ManajemenUserController::class, 'edit'])->name('admin.manajemenuser.edit');
        // Route::patch('/daftaruser/{user}',  [ManajemenUserController::class, 'update'])->name('admin.manajemenuser.update');
        // Route::delete('/daftaruser/delete',  [ManajemenUserController::class, 'destroy'])->name('admin.manajemenuser.delete');
    });

    // Penduduk
    Route::middleware('role:penduduk')->group(function(){
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/pendudukdashboard', function () {

            $totalKelahiranPend = Birth::count(); // Calculate total birth requests
            $totalKematianPend = Death::count(); // Calculate total death requests

            return view('penduduk.dashboard', compact('totalKelahiranPend', 'totalKematianPend'));
        })->name('pendudukdashboard');

        Route::resource('kelahiranpenduduk', KelahiranController::class);
        Route::get('/kelahiran/penduduk/download/{id}', [KelahiranController::class, 'downloadPdf'])->name('kelahiranpenduduk.downloadPdf');

        Route::resource('kematianpenduduk', KematianController::class);
        Route::get('/kematian/penduduk/download/{id}', [KematianController::class, 'downloadPdf'])->name('kematianpenduduk.downloadPdf');
    });
});


// Route::post('/permohonan-kelahiran', [KelahiranController::class, 'create'])->middleware('auth');

require __DIR__.'/auth.php';
