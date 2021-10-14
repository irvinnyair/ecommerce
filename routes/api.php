<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prueba\ProductsController;

Route::get('/products', [ProductsController::class, 'show']);