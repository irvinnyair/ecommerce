<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use App\Models\ColorSize as Pivot;
use App\Models\Size;
use Livewire\Component;

class ColorSize extends Component
{

    public $size,$colors, $color_id, $quantity, $open=false;

    public $pivot,$pivot_color_id,$pivot_quantity;

    protected $listeners = ['delete'];

    protected $rules = [

        'color_id' => 'required',
        'quantity'  => 'required|numeric'

    ];

    public function mount(){

        $this->colors = Color::all();

    }

    public function save(){

        $this->validate();

        $pivot = Pivot::where('color_id', $this->color_id)
                        ->where('size_id', $this->size->id)
                        ->first();


        if ($pivot) {

            $pivot->quantity = $pivot->quantity + $this->quantity;

            $pivot->save();

        } else {
            //atach() para agregar registros en la tabla intermedia
            //en este caso la tabla color_product
            $this->size->colors()->attach([
                //id del colro a relacionar con el prodcut
                $this->color_id => [
                    //Al mismo tiempo agregamos la cantidad
                    'quantity' => $this->quantity
                ]
            ]);
        }
        

        

        //Para limpiar los inputs
        $this->reset(['color_id','quantity']);

        $this->emit('saved');

        $this->size = $this->size->fresh();


    }

    //Rexibimimos la info que enviamos desde la vista
    public function edit(Pivot $pivot){

        $this->open = true;

        $this->pivot = $pivot;

        $this->pivot_color_id = $pivot->color_id;

        $this->pivot_quantity = $pivot->quantity;

    }

    public function update(){

        $this->validate([

            'pivot_color_id' => 'required',
            'pivot_quantity' => 'required',

        ]);


        $this->pivot->color_id = $this->pivot_color_id;
        $this->pivot->quantity = $this->pivot_quantity;

        $this->pivot->save();

        //Refrescar y actualizar la tabla
        $this->size = $this->size->fresh();

        $this->reset('open');

    }

    public function delete(Pivot $pivot){
        
        $pivot->delete();
        $this->size = $this->size->fresh();

    }

    public function render()
    {

        $size_colors = $this->size->colors;

        return view('livewire.admin.color-size', compact('size_colors'));
    }
}
