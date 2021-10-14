<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{

    public $product, $colors;
    public $color_id = "";
    public $qty = 1;
    public $quantity = 0;
    public $options = [
        'size_id' => null
    ];

    public function mount(){
        $this->colors = $this->product->colors;
        $this->options['image'] = Storage::url($this->product->images->first()->url);
    }

    /* 
        Al llamar la variable $select_color, la funcion updatedSelectColor toma de esta variable su nombre
        pasa de $select_color a SelectColor, el update viene por defecto
    */
    public function updatedColorId($value){
        
        //Pivot hace referencia a la table intermedia de una relacion muchos a muchos
        //Revisar la relacion colors del modelo Product

        $color = $this->product->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id); //$color->pivot->quantity;
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }

    public function decrement(){
        
        $this->qty = $this->qty - 1;
         
    }

    public function increment(){

        $this->qty = $this->qty + 1;
    
    }
    
    public function addItem(){
        Cart::add([
            'id' => $this->product->id, 
            'name' =>  $this->product->name, 
            'qty' => $this->qty, 
            'price' => $this->product->price, 
            'weight' => 550, 
            'options' => $this->options
        ]);

        $this->quantity = qty_available($this->product->id, $this->color_id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }

    

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }
}
