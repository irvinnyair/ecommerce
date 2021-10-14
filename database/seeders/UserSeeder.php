<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Irvin Yair Bustamante',
            'email' => 'irvinn.yair@gmail.com',
            'password' => bcrypt('Miyabi12')
        ]);
    }
}
