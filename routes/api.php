<?php

use App\Http\Controllers\KategorijaUlaznicaController;
use App\Http\Controllers\SportskiDogadjajController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\UcesceTimaController;
use App\Http\Controllers\UlaznicaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/sportskidogadjaji', [SportskiDogadjajController::class,'index']);
Route::get('/sportskidogadjaji/{id}', [SportskiDogadjajController::class,'show']);
Route::post('/sportskidogadjaji', [SportskiDogadjajController::class,'store']);
Route::delete('/sportskidogadjaji/{id}', [SportskiDogadjajController::class,'destroy']);
Route::put('/sportskidogadjaji/{id}', [SportskiDogadjajController::class,'update']);

Route::get('/kategorijeulaznica', [KategorijaUlaznicaController::class,'index']);
Route::get('/kategorijeulaznica/{id}', [KategorijaUlaznicaController::class,'show']);
Route::post('/kategorijeulaznica', [KategorijaUlaznicaController::class,'store']);
Route::delete('/kategorijeulaznica/{id}', [KategorijaUlaznicaController::class,'destroy']);
Route::put('/kategorijeulaznica/{id}', [KategorijaUlaznicaController::class,'update']);

Route::get('/timovi', [TimController::class,'index']);
Route::get('/timovi/{id}', [TimController::class,'show']);
Route::post('/timovi', [TimController::class,'store']);
Route::delete('/timovi/{id}', [TimController::class,'destroy']);
Route::put('/timovi/{id}', [TimController::class,'update']);

Route::get('/uscescatima', [UcesceTimaController::class,'index']);
Route::get('/uscescatima/{id}', [UcesceTimaController::class,'show']);
Route::post('/uscescatima', [UcesceTimaController::class,'store']);
Route::delete('/uscescatima/{id}', [UcesceTimaController::class,'destroy']);
Route::put('/uscescatima/{id}', [UcesceTimaController::class,'update']);

// Route::get('/ulaznice', [UlaznicaController::class,'index']);
// Route::get('/ulaznice/{id}', [UlaznicaController::class,'show']);
// Route::post('/ulaznice', [UlaznicaController::class,'store']);
// Route::delete('/ulaznice/{id}', [UlaznicaController::class,'destroy']);
// Route::put('/ulaznice/{id}', [UlaznicaController::class,'update']);
Route::resource('/ulaznice', UlaznicaController::class);
