<?php

use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReligionController;

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

// dashboard
Route::get('/', function () {
    $jumlahpegawai = Employee::count();
    $jumlahpegawaiPria = Employee::where('jeniskelamin', 'Pria')->count();
    $jumlahpegawaiWanita = Employee::where('jeniskelamin', 'Wanita')->count();

    return view('welcome', compact('jumlahpegawai', 'jumlahpegawaiPria', 'jumlahpegawaiWanita'));
})->middleware('auth');

// tampilan tabel data pegawai
Route::group(['middleware' => ['auth', 'hakakses:admin,user']], function(){
    Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai');
});

// Auth login dan register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-user', [LoginController::class, 'registeruser'])->name('register-user');

// logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// tambah data pegawai
Route::get('/add-data', [EmployeeController::class, 'show'])->name('add-data');
Route::post('/create', [EmployeeController::class, 'create'])->name('create');

// edit dan updatae data pegawai
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('/edit/{id}');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('/update/{id}');

// delete data pegawai
Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('/delete/{id}');

// export pdf
Route::get('/export-pdf', [EmployeeController::class, 'exportpdf'])->name('export-pdf');
// export excel dan import excel
Route::get('/export-excel', [EmployeeController::class, 'exportexcel'])->name('export-excel');
Route::post('/import-excel', [EmployeeController::class, 'importexcel'])->name('import-excel');

Route::get('/religion', [ReligionController::class, 'index'])->name('religion')->middleware('auth');
Route::get('/add-religion', [ReligionController::class, 'show'])->name('add-religion');
Route::get('/create', [ReligionController::class, 'create'])->name('create');
