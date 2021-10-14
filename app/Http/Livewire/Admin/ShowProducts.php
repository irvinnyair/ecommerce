<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

//User explicitamenten la paginacion
use Livewire\WithPagination;

class ShowProducts extends Component
{

    use WithPagination;

    public $search;

    //Si se busca retorna a la paágia inicial
    public function updatingSearch(){
        //Reseter la pagina y volver a la 1
        $this->resetPage();

    }

    public function render()
    {

        $products = Product::where('name', 'like' , '%' . $this->search . '%')->paginate(10);
        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');

    }
}
