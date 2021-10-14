<?php

//REgistrar los obervers en la carpeta App/Providers/EventServicesProvaider
//El observe se ejecuta cuando le decimos que hacer en una determinada accion
//En este caso las acciones provenienen del modelo Prodcut

namespace App\Observers;
use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{

    //Cuando el modelo detecte una actualizacion, se ejecutar este observer
    public function updated(Product $product){

        $subcategory_id = $product->subcategory_id;

        $subcategory = Subcategory::find($subcategory_id);

        if($subcategory->size){

            if($product->colors->count()){

                $product->colors()->detach();

            }

        }elseif($subcategory->color){

            if($product->sizes->count()){

                foreach ($product->sizes as $size){

                    $size->delete();

                }

            }

        }else{

            if($product->colors->count()){

                $product->colors()->detach();

            }

            if($product->sizes->count()){

                foreach ($product->sizes as $size){

                    $size->delete();

                }

            }

        }

    }

}
