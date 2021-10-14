<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CreateCategory extends Component
{

    use WithFileUploads;
    public $brands,$categories, $category, $rand;

    protected $listeners = ['delete'];

    public $createForm = [
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'brands' => []
    ];

    public $editForm = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'icon' => null,
        'image' => null,
        'brands' => []
    ]; 

    public $editImage;

    protected $rules = [

        'createForm.name'   => 'required',
        'createForm.slug'   => 'required|unique:categories,slug',
        'createForm.icon'   => 'required',
        'createForm.image'  => 'required|image|max:1024',
        'createForm.brands' => 'required'

    ];

    protected $validationAttributes = [

        'createForm.name' => 'nombre',
        'createForm.slug' => 'Slug',
        'createForm.icon' => 'Ícono',
        'createForm.image' => 'Imagen',
        'createForm.brands' => 'Marcas'

    ];


    public function mount(){

        $this->getBrands();
        $this->getCategories();
        $this->rand = rand();

    }

    public function updatedCreateFormName($value)
    {
        $this->createForm['slug'] = Str::slug($value);
    }

    public function getBrands(){

        $this->brands = Brand::all();

    }

    public function getCategories(){

        $this->categories = Category::all();

    }

    public function save(){

        $this->validate();

        //Subir Imagen
        //alamcenamos la url en $image
        $image = $this->createForm['image']->store('categories');

        $category = Category::create([
            'name'  => $this->createForm['name'],
            'slug'  => $this->createForm['slug'],
            'icon'  => $this->createForm['icon'],
            'image' => $image
            //Guardar la marca en la relacion(tabla intermedia)
        ]);

        $category->brands()->attach($this->createForm['brands']);

        $this->rand =rand();
        $this->reset('createForm');

        $this->getCategories();

        $this->emit('saved');

    }

    public function edit(Category $category){

        $this->category = $category;

        $this->editForm['open']     =  true;
        $this->editForm['name']     = $category->name;
        $this->editForm['slug']     = $category->slug;
        $this->editForm['icon']     = $category->icon;
        $this->editForm['image']    = Storage::url($category->image);
        $this->editForm['brands']   = $category->brands->pluck('id');


    }

    public function delete(Category $category){

        $category->delete();

        $this->getCategories();

    }

    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
