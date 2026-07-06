<?php

use App\Http\Controllers\Main\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('main.index');
