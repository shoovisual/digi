<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'All Products', 'icon' => 'products/category/all.svg'],
            ['name' => 'TVs', 'icon' => 'products/category/tvs.svg'],
            ['name' => 'Refrigerator', 'icon' => 'products/category/refrigerator.svg'],
            ['name' => 'Freezers', 'icon' => 'products/category/freezers.svg'],
            ['name' => 'Air Conditioner', 'icon' => 'products/category/acs.svg'],
            ['name' => 'Gas Cooker', 'icon' => 'products/category/gas-cooker.svg'],
            ['name' => 'Washing Machine', 'icon' => 'products/category/washing-machine.svg'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
