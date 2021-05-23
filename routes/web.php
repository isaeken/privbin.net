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


Route::view('/', 'web.home.index')->name('home');

Route::prefix('/asset')->name('assets.')->group(function () {
    Route::get('/embed.js', [\App\Http\Controllers\Web\AssetController::class, 'embed'])->name('embed');
});

Route::view('test', 'test');

Route::prefix('workspaces')->group(function () {

});

Route::prefix('notes')->name('notes.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Web\NoteController::class, 'index'])->name('index')->middleware('auth');
    Route::get('/{note}', [\App\Http\Controllers\Web\NoteController::class, 'show'])->name('show');
    Route::get('/{note}/raw', [\App\Http\Controllers\Web\NoteController::class, 'raw'])->name('show.raw');
    Route::get('/{note}/embed', [\App\Http\Controllers\Web\NoteController::class, 'embed'])->name('show.embed');

    Route::get('/{note}/destroy', [\App\Http\Controllers\Web\NoteController::class, 'destroy'])->name('destroy')->middleware('auth');
    Route::match(['GET', 'POST'], '/{note}/auth', [\App\Http\Controllers\Web\NoteController::class, 'auth'])->name('auth');
    Route::post('/store', [\App\Http\Controllers\Web\NoteController::class, 'store'])->name('store');
});
