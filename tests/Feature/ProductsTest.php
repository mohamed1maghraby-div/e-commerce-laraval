<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Database\Seeders\TagSeeder;
use Database\Seeders\WorldSeeder;
use Database\Seeders\EntrustSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\UserAddressSeeder;
use Database\Seeders\WorldStatusSeeder;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\ProductsTagsSeeder;
use Database\Seeders\ProductCouponSeeder;
use Database\Seeders\ProductReviewSeeder;
use Database\Seeders\ProductsImagesSeeder;
use Database\Seeders\ProductCategorySeeder;
use Database\Seeders\ShippingCompanySeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    
    use RefreshDatabase;
    
    

    public function test_product_conatains_non_empty_table(): void
    {
        $this->seed([
            EntrustSeeder::class,
            ProductCategorySeeder::class,
            TagSeeder::class,
            ProductSeeder::class,
            ProductsTagsSeeder::class,
            ProductsImagesSeeder::class,
            ProductCouponSeeder::class,
            ProductReviewSeeder::class
        ]);


        $user = $this->getUser();
        $lastProduct = Product::latest()->first();

        $response = $this->actingAs($user)->get('/admin/products');
        
        $response->assertStatus(200);

        $response->assertDontSee('No products found');
        $response->assertViewHas('products', function($collection) use($lastProduct){
            return $collection->contains($lastProduct);
        });
        //assertDatabaseHas()
    }

    public function test_paginated_products_table_doesnt_contain_11th_record(): void
    {
        $user = $this->getUser();
        $lastProduct = Product::latest()->first();
        
        $response = $this->actingAs($user)->get('/admin/products');

        $response->assertStatus(200);
        $response->assertViewHas('products', function($collection) use($lastProduct){
            return $collection->contains($lastProduct);
        });
    }

    public function test_unauthenticated_user_cannot_access_product()
    {
        $response = $this->get('/admin/products');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    private function getUser(): User
    {
        return User::find(1);
    }
}
