<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Food'
            ],
            [
                'name' => 'Drink'
            ],
            [
                'name' => 'Snack'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
