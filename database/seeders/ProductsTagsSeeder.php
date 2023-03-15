<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductsTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = Tag::whereStatus(true)->pluck('id')->toArray();

        Product::all()->each(function (Product $product) use ($tags) {
            $product->tags()->attach(Arr::random($tags, rand(2, 3)));
        });
    }
}
