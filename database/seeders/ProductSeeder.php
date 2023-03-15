<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $categories = ProductCategory::whereNotNull('parent_id')->pluck('id');

        for($i=1; $i<=1000; $i++){
            $products[] = [
                'name' => $faker->sentence(2, true),
                'slug' => $faker->unique()->slug(2, true),
                'description' => $faker->sentence(10, true),
                'price' => $faker->numberBetween(5, 200),
                'quantity' => $faker->numberBetween(10, 100),
                'product_category_id' => $categories->random(),
                'featured' => rand(0, 1),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $chunks = array_chunk($products, 100);
        foreach($chunks as $chunk){
            Product::insert($chunk);
        }
    }
}
