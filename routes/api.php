<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategorijaUlaznicaController;
use App\Http\Controllers\SportskiDogadjajController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\UcesceTimaController;
use App\Http\Controllers\UlaznicaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// authentication ruta //

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

//resource ruta//

Route::resource('sportskidogadjaji', SportskiDogadjajController::class)->only(['index', 'show']);
Route::resource('kategorijeulaznica', KategorijaUlaznicaController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('sportskidogadjaji', SportskiDogadjajController::class)->only(['store', 'update', 'destroy']);
    Route::resource('kategorijeulaznica', KategorijaUlaznicaController::class)->only(['store', 'update', 'destroy']);
});

//grupa ruta//

Route::prefix('timovi')->name('timovi.')->group(function () {
    Route::get('/', [TimController::class, 'index'])->name('index');
    Route::get('/{id}', [TimController::class, 'show'])->name('show');
});

Route::middleware('auth:sanctum')->prefix('timovi')->name('timovi.')->group(function () {
    Route::post('/', [TimController::class, 'store'])->name('store');
    Route::put('/{id}', [TimController::class, 'update'])->name('update');
    Route::delete('/{id}', [TimController::class, 'destroy'])->name('destroy');
});

Route::prefix('uscescatima')->name('uscescatima.')->group(function () {
    Route::get('/', [UcesceTimaController::class, 'index'])->name('index');
    Route::get('/{id}', [UcesceTimaController::class, 'show'])->name('show');
});

Route::middleware('auth:sanctum')->prefix('uscescatima')->name('uscescatima.')->group(function () {
    Route::post('/', [UcesceTimaController::class, 'store'])->name('store');
    Route::put('/{id}', [UcesceTimaController::class, 'update'])->name('update');
    Route::delete('/{id}', [UcesceTimaController::class, 'destroy'])->name('destroy');
});

//dinamicka ruta//

Route::get('/ulaznice/{id}', [UlaznicaController::class, 'show'])->where('id', '[0-9]+');
Route::get('/ulaznice', [UlaznicaController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/ulaznice', [UlaznicaController::class, 'store']);
    Route::put('/ulaznice/{id}', [UlaznicaController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/ulaznice/{id}', [UlaznicaController::class, 'destroy'])->where('id', '[0-9]+');
});

Route::get('/ulaznice/filter/{status}', function ($status) {
    return response()->json([
        'status' => $status,
        'message' => "Filterovanje ulaznica po statusu: {$status}"
    ]);
})->where('status', '[a-z]+');

Route::fallback(function (Request $request) {
    return response()->json([
        'error' => 'Ruta nije pronađena',
        'message' => "The endpoint {$request->method()} {$request->path()} does not exist.",
        'status' => 404,
        'timestamp' => now(),
        'method' => $request->method(),
        'path' => $request->path()
    ], 404);
});
