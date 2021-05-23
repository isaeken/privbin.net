<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v2')->name('api.')->group(function () {
    Route::match(['GET', 'POST'], '/make-embed-url/{note}', [\App\Http\Controllers\Web\NoteController::class, 'makeEmbedUrl'])->name('make-embed-url');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
