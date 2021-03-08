<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstnamesController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\ExcelController;

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
    return view('welcome');
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    /*
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    */
    Route::resource('notes', \App\Http\Controllers\NotesController::class);
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::get('species/{id}/estnames/reset', [SpeciesController::class, 'reset_estnames'])->name('species.estnames.reset');
    Route::resource('species', SpeciesController::class);
    Route::put('estnames/{id}/confirm', [EstnamesController::class, 'confirm'])->name('estnames.confirm');
    Route::get('estnames/termeki', [EstnamesController::class, 'termeki'])->name('estnames.termeki');
    Route::put('estnames/termeki', [EstnamesController::class, 'savetermeki'])->name('estnames.savetermeki');
    Route::put('estnames/{id}/finish', [EstnamesController::class, 'finish'])->name('estnames.finish');
    Route::resource('estnames', EstnamesController::class);

    // excel stuff
    Route::get('import-export', [ExcelController::class, 'importExportView'])->name('excel.import-export');
    Route::get('excel-export', [ExcelController::class, 'export'])->name('excel.export');
    Route::post('excel-import', [ExcelController::class, 'import'])->name('excel.import');
});

