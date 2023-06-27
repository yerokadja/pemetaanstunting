<?php

use App\Http\Controllers\AccountController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\kecamatan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\perhitungan;
use App\Http\Controllers\Profilcontroller;
use App\Http\Controllers\ProfiltController;
use App\Http\Controllers\Registercontroller;
use App\Http\Controllers\stunting;
use App\Http\Controllers\variablecontroller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/posts', [PostController::class, 'index']);

//login

Route::get('/', [LoginController::class, 'index']);
Route::POST('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//user
// Route::POST('/registerstore', [Registercontroller::class, 'registerstore']);
// Route::POST('/authenticate', [UserController::class, 'authenticate']);
// Route::POST('/ulogout', [UserController::class, 'logout'])->name('logout');
// Route::get('/', [UserController::class, 'index']);
// Route::get('/pasien', [UserController::class, 'pasien']);
// Route::get('/grafik', [UserController::class, 'grafik']);
// Route::get('/berita-detail', [UserController::class, 'beritadetail']);
// Route::get('/visi-misi', [UserController::class, 'visimisi']);
// Route::POST('/hapussession', [UserController::class, 'hapusseesion']);

Route::middleware('cek')->prefix('/dashboard')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard.index');
    Route::resource('/profil', Profilcontroller::class);
    Route::resource('/profile-setting', ProfiltController::class);
    Route::resource('/password-setting', AccountController::class);
    Route::resource('/kecamatan', kecamatan::class);
    Route::resource('/stunting', stunting::class);
    // Route::resource('/cluster', ClusterController::class);
    // Route::resource('/variable', variablecontroller::class);
    Route::get('/perhitungan', [perhitungan::class, 'show']);
    Route::get('/hasil', [perhitungan::class, 'hasil']);
    Route::get('/map', [AdminController::class, 'map']);
});
