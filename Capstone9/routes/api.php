<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::get('/services/{service}', [ServiceController::class, 'show']);