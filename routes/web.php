<?php

use App\Http\Controllers\IncomingLetterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentFromController;

Route::get('/', [DocumentFromController::class, "index"])->name("index");

Route::get('/incoming_letters/create', [IncomingLetterController::class, 'create'])->name('incoming_letter.create');
Route::post('/incoming_letters', [IncomingLetterController::class, 'store'])->name('incoming_letter.store');

Route::get('/incoming_letters/{incoming_letter}/edit', [IncomingLetterController::class, 'edit'])->name('incoming_letter.edit');
Route::patch('/incoming_letters/{incoming_letter}', [IncomingLetterController::class, 'update'])->name('incoming_letter.update');
