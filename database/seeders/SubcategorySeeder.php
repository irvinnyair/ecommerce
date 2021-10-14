<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            //Celulares y Tablets
            [
                'category_id' => 1,
                'name' => 'Celulares y smartphone',
                'slug' => Str::slug('Celulares y smartphone'),
                'color' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Accesorios para celulares',
                'slug' => Str::slug('Accesorios para celulares')
            ],
            [
                'category_id' => 1,
                'name' => 'Smartwatches',
                'slug' => Str::slug('Smartwathes')
            ],

            //Tv, Audio y Video
            [
                'category_id' => 2,
                'name' => 'Tv y audio',
                'slug' => Str::slug('Tv y audio')
            ],
            [
                'category_id' => 2,
                'name' => 'Audios',
                'slug' => Str::slug('Audios')
            ],
            [
                'category_id' => 2,
                'name' => 'Audio para autos',
                'slug' => Str::slug('Audio para autos')
            ],

            //Consola y videojuegos
            [
                'category_id' => 3,
                'name' => 'Xbox',
                'slug' => Str::slug('Xbox')
            ],
            [
                'category_id' => 3,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station')
            ],
            [
                'category_id' => 3,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC')
            ],
            [
                'category_id' => 3,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo')
            ],

            //Computacion
            [
                'category_id' => 4,
                'name' => 'Laptops',
                'slug' => Str::slug('Laptops')
            ],
            [
                'category_id' => 4,
                'name' => 'PC de escritorio',
                'slug' => Str::slug('PC de escritorio')
            ],
            [
                'category_id' => 4,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento')
            ],
            [
                'category_id' => 4,
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios')
            ],

            //Moda
            [
                'category_id' => 5,
                'name' => 'Damas',
                'slug' => Str::slug('Damas'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Caballeros',
                'slug' => Str::slug('Caballeros'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes')
            ],
            [
                'category_id' => 5,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes')
            ],

        ];

        foreach($subcategories as $subcategory){
            Subcategory::factory(1)->create($subcategory);
        }
    }
}
