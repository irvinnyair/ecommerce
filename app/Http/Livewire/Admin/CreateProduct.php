<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProduct extends Component
{

    public $categories, $subcategories = [], $brands = [];

    public $category_id = "", $subcategory_id = "", $brand_id = "";

    public $name,$slug,$description, $price, $quantity;

    protected $rules = [
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        'brand_id' => 'required',
        'price' => 'required'
        
    ];

    //Funcion que esta a la escucha del cambio de valor en $category_id
    //$value => valor por el que cambia
    public function updatedCategoryId($value){

        $this->subcategories = Subcategory::where('category_id', $value)->get();


        //whereHas para acceder a una relacion
        //Builder $query, para hacer uso de la relacion
        //use ($value) para hacer uso global de elementos en este caso el $value
        $this->brands = Brand::whereHas('categories', function(Builder $query) use ($value){

            $query->where('category_id', $value);

        })->get();

        $this->reset(['subcategory_id', 'brand_id']);

    }

    public function updatedName($value){

        $this->slug = Str::slug($value);

    }

    //Prpiedad computada
    public function getSubcategoryProperty()
    {
        return Subcategory::find($this->subcategory_id);
    }

    //iniciar propiedad
    public function mount(){

        $this->categories = Category::all();
    }

    public function save(){

        $rules = $this->rules;


        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){

                $rules['quantity'] = 'required';

            }
        }

        $this->validate($rules);

        $product = new Product();

        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->subcategory_id = $this->subcategory_id;
        $product->brand_id = $this->brand_id;
        

        if($this->subcategory_id){
            if(!$this->subcategory->color && !$this->subcategory->size){

                $product->quantity = $this->quantity;

            }
        }

        $product->save();
        
        return redirect()->route('admin.products.edit', $product);

    }

    public function render()
    {
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
