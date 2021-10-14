<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{

    public $product,$categories,$subcategories,$brands, $slug;

    public $category_id;

    protected $rules = [
        'category_id' => 'required',
        'product.subcategory_id' => 'required',
        'product.name' => 'required',
        'slug' => 'required|unique:products,slug',
        'product.description' => 'required',
        'product.brand_id' => 'required',
        'product.price' => 'required',
        'product.quantity' => 'numeric',
    ];

    protected $listeners = ['refreshProduct', 'delete'];

    public function mount(Product $product){

        $this->product = $product;

        $this->categories = Category::all();

        $this->category_id = $product->subcategory->category->id;

        $this->subcategories = Subcategory::where('category_id', $this->category_id)->get();

        $this->slug = $this->product->slug;

        $this->brands = Brand::whereHas('categories', function(Builder $query){
            $query->where('category_id', $this->category_id);
        })->get();
        
    }

    public function refreshProduct(){

        $this->product = $this->product->fresh();

    }

    public function updatedProductName($value){
        $this->slug = Str::slug($value);
    }


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

        /* $this->reset(['subcategory_id', 'brand_id']); */

        $this->product->subcategory_id = "";
        $this->product->brand_id = "";

    }

    //Prpiedad computada
    public function getSubcategoryProperty(){

        return Subcategory::find($this->product->subcategory_id);

    }

    public function save()
    {
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:products,slug,' . $this->product->id;

        if ($this->product->subcategory_id) {
            if (!$this->subcategory->color && !$this->subcategory->size) {
                $rules['product.quantity'] = 'required|numeric';
            }
        }

        $this->validate($rules);

        $this->product->slug = $this->slug;

        $this->product->save();

        $this->emit('saved');
    }

    public function deleteImage(Image $image){
        
        Storage::delete([$image->url]);

        $image->delete();

        $this->product = $this->product->fresh();

    }

    public function delete()
    {
        $images = $this->product->images;

        foreach($images as $image){

            Storage::delete($image->url);
            $image->delete();

        }

        $this->product->delete();

        return redirect()->route('admin.index');

    }

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }
}
