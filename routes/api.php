<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/tag/{idTag}/nivel/{level}', [TagController::class, 'index']);
