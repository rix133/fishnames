<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstnamesController;
use App\Http\Controllers\SpeciesController;

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
    Route::resource('estnames', EstnamesController::class);
});

