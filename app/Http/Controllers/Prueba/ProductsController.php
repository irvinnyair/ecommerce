<?php

namespace App\Http\Controllers\Prueba;
use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show(){
        
        $products = Product::all();

        return $products;

    }
}
