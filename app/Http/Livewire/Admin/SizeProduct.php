<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;

class SizeProduct extends Component
{

    public $product, $name, $open = false;

    public $size,$name_edit;

    //se encarga de escuchar los eventos javascript
    //ejecuta la funcion con el mismo nombre
    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required'
    ];

    public function save(){

        $this->validate();

        $size = Size::where('product_id', $this->product->id
        )
                        ->where('name', $this->name)
                        ->first();

        if ($size) {

            $this->emit('errorSize', 'La talla ya existe');

        } else {

            //No es necesario proporcionar el id, ya que viene desde la variable product y se toma junto la relacion save()
            $this->product->sizeS()->create([
                'name' => $this->name
            ]);
        }
        

        

        //Para limpiar los inputs
        $this->reset(['name']);

        $this->product = $this->product->fresh();

    }

    public function edit(Size $size){

        $this->open = true;
        $this->size = $size;
        $this->name_edit = $size->name;

    }

    public function update(){
        
        $this->validate([
            
            'name_edit' => 'required'

        ]);

        $this->size->name = $this->name_edit;

        $this->size->save();

        $this->product = $this->product->fresh();

        $this->open = false;


    }

    public function delete(Size $size){

       $size->delete();

       $this->product = $this->product->fresh();
    }

    public function render()
    {
        $sizes = $this->product->sizes;

        return view('livewire.admin.size-product',  compact('sizes'));
    }
}
