<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            $name = $faker->sentence;
            $description = $faker->paragraph;
            $price = $faker->randomFloat(2, 1, 1000);
            $stock = $faker->numberBetween(1, 100);
            $supplier_email = $faker->email;
            $category_id = Category::pluck('id')->random();

            Product::create([
                'name' => $name,
                'category_id' => $category_id,
                'description' => $description,
                'price' => $price,
                'stock' => $stock,
                'supplier_email' => $supplier_email,
            ]);
        }
    }
}
