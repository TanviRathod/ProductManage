<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoties =[
            [
               'name'=>'Mobile phones',
            ],
            [
                'name'=>'Game consoles',
            ],
            [
                'name'=>'Household furniture',
            ],
            [
                'name'=>'Home appliances',
            ],
            [
                'name'=>'Clothing',
            ]
            ];
            foreach ($categoties as $key => $user) {
                Category::create($user);
            }
    }
}
