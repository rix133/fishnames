<?php

use Illuminate\Support\Facades\Route;

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
    Route::resource('species', \App\Http\Controllers\SpeciesController::class);
    Route::resource('estnames', \App\Http\Controllers\EstnamesController::class);
});

