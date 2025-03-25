<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IncomingLetterController;
use App\Http\Controllers\OutgoingLetterBinController;
use App\Http\Controllers\OutgoingLetterController;
use App\Http\Controllers\AutorizationController;
use App\Http\Controllers\IncomingLetterBinController;
use App\Http\Middleware\EnsureIsUserAdmin;
use App\Http\Middleware\EnsureIsUserBanned;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\Login;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/incoming_letters', [IncomingLetterController::class, "index"])->name('incoming_letter.index')->middleware(['auth', EnsureIsUserBanned::class]);

Route::get('/outgoing_letters', [OutgoingLetterController::class, "index"])->name('outgoing_letter.index')->middleware('auth');

Route::get('/incoming_letters/create', [IncomingLetterController::class, 'create'])->name('incoming_letter.create')->middleware('auth');
Route::post('/incoming_letters', [IncomingLetterController::class, 'store'])->name('incoming_letter.store')->middleware('auth');

Route::get('/incoming_letters/{incoming_letter}/edit', [IncomingLetterController::class, 'edit'])->name('incoming_letter.edit')->middleware('auth');
Route::patch('/incoming_letters/{incoming_letter}', [IncomingLetterController::class, 'update'])->name('incoming_letter.update')->middleware('auth');

Route::delete('/incoming_letters/{incoming_letter}', [IncomingLetterController::class, 'destroy'])->name('incoming_letter.delete')->middleware('auth');

Route::get('/outgoing_letters/create', [OutgoingLetterController::class, 'create'])->name('outgoing_letter.create')->middleware('auth');
Route::post('/outgoing_letters', [OutgoingLetterController::class, 'store'])->name('outgoing_letter.store')->middleware('auth');

Route::get('/outgoing_letters/{outgoing_letter}/edit', [OutgoingLetterController::class, 'edit'])->name('outgoing_letter.edit')->middleware('auth');
Route::patch('/outgoing_letters/{outgoing_letter}', [OutgoingLetterController::class, 'update'])->name('outgoing_letter.update')->middleware('auth');

Route::delete('/outgoing_letters/{outgoing_letter}', [OutgoingLetterController::class, 'destroy'])->name('outgoing_letter.delete')->middleware('auth');

Route::get('/incoming_letters/bin', [IncomingLetterBinController::class, "index"])->name('incoming_letter.bin')->middleware('auth');
Route::post('/incoming_letters/bin/{incoming_letter}', [IncomingLetterBinController::class, "restore"])->name('incoming_letter.restore')->withTrashed()->middleware('auth');
Route::delete('/incoming_letters/bin/{incoming_letter}', [IncomingLetterBinController::class, "destroy"])->name('incoming_letter.destroy')->withTrashed()->middleware('auth');

Route::get('/outgoing_letters/bin', [OutgoingLetterBinController::class, "index"])->name('outgoing_letter.bin')->middleware('auth');
Route::post('/outgoing_letters/bin/{outgoing_letter}', [OutgoingLetterBinController::class, "restore"])->name('outgoing_letter.restore')->withTrashed()->middleware('auth');
Route::delete('/outgoing_letters/bin/{outgoing_letter}', [OutgoingLetterBinController::class, "destroy"])->name('outgoing_letter.destroy')->withTrashed()->middleware('auth');

Route::get('/admin', [AdminController::class,'index'])->name("admin")->middleware(["auth", EnsureIsUserAdmin::class]);
Route::get('/admin/create', [AdminController::class,'create'])->name("admin.create")->middleware(["auth", EnsureIsUserAdmin::class]);

Route::delete('/admin/{user}', [AdminController::class, "destroy"])->name('admin.destroy')->middleware(["auth", EnsureIsUserAdmin::class]);
Route::patch('/admin/{user}', [AdminController::class, "ban"])->name("admin.ban")->middleware(["auth", EnsureIsUserAdmin::class]);

Auth::routes(['register' => false,
'reset' => false,
'verify' => false,]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {
//     return redirect()->route("auth");
//     })->name("home");

//     Route::get('/login', [\App\Http\Controllers\Auth\Login::class, 'login'])->name("login");
//     Route::post('/auth', [\App\Http\Controllers\Auth\Login::class, 'auth'])->name("auth");
