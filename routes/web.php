<?php

use App\Http\Controllers\IncomingLetterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentFromController;

Route::get('/', [DocumentFromController::class, "index"])->name("index");
Route::get('/incoming_letters/create', [IncomingLetterController::class, 'create'])->name('incoming_letter.create');

Route::post('/incoming_letters', [IncomingLetterController::class, 'store'])->name('incoming_letter.store');
