<?php

use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\OutgoingLetterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentFromController;

Route::get('/', [OutgoingLetterController::class, "index"])->name("index");

Route::get('/incoming_letters/create', [IncomingLetterController::class, 'create'])->name('incoming_letter.create');
Route::post('/incoming_letters', [IncomingLetterController::class, 'store'])->name('incoming_letter.store');

Route::get('/incoming_letters/{incoming_letter}/edit', [IncomingLetterController::class, 'edit'])->name('incoming_letter.edit');
Route::patch('/incoming_letters/{incoming_letter}', [IncomingLetterController::class, 'update'])->name('incoming_letter.update');

Route::get('/outgoing_letters/create', [OutgoingLetterController::class, 'create'])->name('outgoing_letter.create');
Route::post('/outgoing_letters', [OutgoingLetterController::class, 'store'])->name('outgoing_letter.store');

Route::get('/outgoing_letters/{outgoing_letter}/edit', [OutgoingLetterController::class, 'edit'])->name('outgoing_letter.edit');
Route::patch('/outgoing_letters/{outgoing_letter}', [OutgoingLetterController::class, 'update'])->name('outgoing_letter.update');
