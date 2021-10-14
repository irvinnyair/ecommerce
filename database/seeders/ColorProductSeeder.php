<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ColorProductSeeder extends Seeder
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
                    ->where('size', false);
        })->get();

        //Recorremos cada campo
        foreach($products as $product){

            //Acceder al modelo product
            //Despues acceder a la relacion que tiene con color
            //Y con attach ingresamos los datos y relacionar los 4 colores con los productos
            //Ingresar la cantidad de producto por color
            $product->colors()->attach([
                1 => ['quantity' => 10],
                2 => ['quantity' => 10],
                3 => ['quantity' => 10],
                4 => ['quantity' => 10]
            ]);

        }
    }
}
