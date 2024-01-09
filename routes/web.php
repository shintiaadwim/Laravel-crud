<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai');

Route::get('/add-data', [EmployeeController::class, 'show'])->name('add-data');
Route::post('/create', [EmployeeController::class, 'create'])->name('create');

Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('/edit/{id}');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('/update/{id}');

Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('/delete/{id}');

// export pdf
Route::get('/export-pdf', [EmployeeController::class, 'exportpdf'])->name('export-pdf');
// export excel dan import excel
Route::get('/export-excel', [EmployeeController::class, 'exportexcel'])->name('export-excel');
Route::post('/import-excel', [EmployeeController::class, 'importexcel'])->name('import-excel');
