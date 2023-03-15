<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => 'Clothes', 'status' => true]);
        Tag::create(['name' => 'Shoes', 'status' => true]);
        Tag::create(['name' => 'Watches', 'status' => true]);
        Tag::create(['name' => 'Electronics', 'status' => true]);
        Tag::create(['name' => 'Mem', 'status' => true]);
        Tag::create(['name' => 'Women', 'status' => true]);
        Tag::create(['name' => 'Boys', 'status' => true]);
        Tag::create(['name' => 'Girls', 'status' => true]);
    }
}
