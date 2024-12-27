<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = ['Electronics', 'Clothing', 'Books', 'Toys', 'Food', 'Furniture'];

        foreach ($categories as $category) {
            Category::insert([
                'name' => $category,
                'description' => $faker->sentence,
            ]);
        }
    }
}
