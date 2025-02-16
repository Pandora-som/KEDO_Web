<?php

use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\OutgoingLetterController;
use App\Http\Controllers\AutorizationController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [OutgoingLetterController::class, "index"])->name("index");

Route::get('/incoming_letters/create', [IncomingLetterController::class, 'create'])->name('incoming_letter.create');
Route::post('/incoming_letters', [IncomingLetterController::class, 'store'])->name('incoming_letter.store');

Route::get('/incoming_letters/{incoming_letter}/edit', [IncomingLetterController::class, 'edit'])->name('incoming_letter.edit');
Route::patch('/incoming_letters/{incoming_letter}', [IncomingLetterController::class, 'update'])->name('incoming_letter.update');

Route::delete('/incoming_letters/{incoming_letter}', [IncomingLetterController::class, 'destroy'])->name('incoming_letter.delete');

Route::get('/outgoing_letters/create', [OutgoingLetterController::class, 'create'])->name('outgoing_letter.create');
Route::post('/outgoing_letters', [OutgoingLetterController::class, 'store'])->name('outgoing_letter.store');

Route::get('/outgoing_letters/{outgoing_letter}/edit', [OutgoingLetterController::class, 'edit'])->name('outgoing_letter.edit');
Route::patch('/outgoing_letters/{outgoing_letter}', [OutgoingLetterController::class, 'update'])->name('outgoing_letter.update');

Route::delete('/outgoing_letters/{outgoing_letter}', [OutgoingLetterController::class, 'destroy'])->name('outgoing_letter.delete');

Route::get('/incoming_letter', [IncomingLetterController::class, "index"])->name('incoming_letter.index');

Route::get('/', [OutgoingLetterController::class, "index"])->name('outgoing_letter.index');

Route::get('/autorization', [AutorizationController::class, "index"])->name('autorization');
