<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
        'icon'
    ];
    use HasFactory;

    public function subcategories(){
        return $this->hasMany(Subcategory::class);
    }

    public function brands(){
        return $this->belongsToMany(Brand::class);
    }

    //Una relacion a tra vez de otra relacion
    //Category
    //SubCAtegory
    //Product
    public function products(){
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }

    //URL Amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
