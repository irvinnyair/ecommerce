<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //whereHas Consulta a las relaciones del modelo
        //Obetenemos si el color es true y size es false
        //Para ingresarle un color
        $products = Product::whereHas('subcategory', function(Builder $query){
            $query->where('color', true)
                    ->where('size', true);
        })->get();

        $sizes = ['Talla S', 'Talla M', 'Talla L'];

        //Recorremos cada campo
        foreach($products as $product){

            //Acceder al modelo product
            //Despues acceder a la relacion que tiene con color
            //Y con attach ingresamos los datos y relacionar los 4 colores con los productos
            //Ingresar la cantidad de producto por color
           
            foreach($sizes as $size){

                $product->sizes()->create([
                    'name' => $size
                ]);
            }

        }
    }
}
