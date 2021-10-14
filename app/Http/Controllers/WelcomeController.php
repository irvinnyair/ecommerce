<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;

class WelcomeController extends Controller
{

    /*
        El metodo invoke sirve para controladores con un unico metodo
        no es cesario decirle a la ruta que metodo va a usar
        ya que detecta invoke y sabe que es el unico existente
    */
    public function __invoke()
    {

        if(auth()->user()){

            $pendiente  = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();

            if ($pendiente) {

                $mensaje = "Usted tiene $pendiente ordenes pendientes. <a class='font-bold' href='". route('orders.index') ."?status=1'>Pagar aquí</a>";
                session()->flash('flash.banner', $mensaje);
            } 
            

            
        }
       /*  session()->flash('flash.bannerStyle', 'danger'); */


        $categories = Category::all();
        return view('welcome', compact('categories'));
    }
}
