<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentFromController;

Route::get('/', [DocumentFromController::class, "index"])->name("index");
