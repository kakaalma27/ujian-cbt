<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JawbanController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\CrudAccountController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UsersJawabanController;
use App\Http\Controllers\UsersKelasController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Route User
Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[HomeController::class, 'userHome'])->name("home");
    Route::post("/home/cek",[UsersJawabanController::class, 'cek'])->name("cek");
    Route::post("/home/store",[UsersJawabanController::class, 'ujian'])->name("ujian");

});
// Route Editor
Route::middleware(['auth','user-role:guru'])->group(function()
{
    Route::get("/guru/home",[HomeController::class, 'guruHome'])->name("guru.home");
    Route::get("/guru/ujian", [UjianController::class, 'index'])->name("guru.ujian");
    Route::post("/guru/upload", [UjianController::class, 'upload'])->name("guru.upload");
    Route::get("/guru/create", [UjianController::class, 'create'])->name("guru.create");
    Route::post("/guru/uploadExcal", [UjianController::class, 'uploadExcal'])->name("guru.uploadExcal");

});
// Route Admin
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[HomeController::class, 'adminHome'])->name("admin.home");
    Route::resource('/admin/account', CrudAccountController::class);
    Route::resource('/admin/pelajaran', PelajaranController::class);
    Route::resource('/admin/kelas', KelasController::class);
    Route::get("/admin/anggota",[UsersKelasController::class, 'create'])->name("admin.anggota");
    Route::post("/admin/upload",[UsersKelasController::class, 'upload'])->name("admin.upload");
});