<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $adminRoule = Role::create(['name' => 'admin', 'display_name' => 'Administration', 'description' => 'Administrator','allowed_route' => 'admin']);
        $supervisorRoule = Role::create(['name' => 'supervisor', 'display_name' => 'Supervisor', 'description' => 'Supervisor','allowed_route' => 'admin']);
        $customerRoule = Role::create(['name' => 'customer', 'display_name' => 'Customer', 'description' => 'Customer','allowed_route' => null]);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'username' => 'admin',
            'email' => 'admin@ecommerce.test',
            'email_verified_at' => now(),
            'mobile' => '96650000000',
            'password' => bcrypt('123456789'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);
        $admin->attachRole($adminRoule);

        $supervisor = User::create([
            'first_name' => 'Supervisor',
            'last_name' => 'System',
            'username' => 'supervisor',
            'email' => 'supervisor@ecommerce.test',
            'email_verified_at' => now(),
            'mobile' => '96650000001',
            'password' => bcrypt('123456789'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);
        $supervisor->attachRole($supervisorRoule);

        $customer = User::create([
            'first_name' => 'Sami',
            'last_name' => 'Mansour',
            'username' => 'Sami',
            'email' => 'Sami@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '96650000002',
            'password' => bcrypt('123456789'),
            'user_image' => 'avatar.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);
        $customer->attachRole($customerRoule);

        for($i=1; $i<=20; $i++){
            $randomcustomer = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile' => '96650'. $faker->numberBetween(1000000, 9999999),
                'password' => bcrypt('123456789'),
                'user_image' => 'avatar.svg',
                'status' => 1,
                'remember_token' => Str::random(10),
            ]);
            $randomcustomer->attachRole($customerRoule);
            
        }


        $manageMain =  Permission::create([ 'name' => 'main', 'display_name' => 'Main', 'description' => 'index', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fas fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();
        
        //PRODUCTS CATEGORY
        $manageProductCategories =  Permission::create([ 'name' => 'manage_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5']);
        $manageProductCategories->parent_show = $manageProductCategories->id;
        $manageProductCategories->save();
        $showProductCategories =  Permission::create([ 'name' => 'show_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProductCategories =  Permission::create([ 'name' => 'create_product_categories', 'display_name' => 'Create Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProductCategories =  Permission::create([ 'name' => 'display_product_categories', 'display_name' => 'Show Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProductCategories =  Permission::create([ 'name' => 'update_product_categories', 'display_name' => 'Update Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProductCategories =  Permission::create([ 'name' => 'delete_product_categories', 'display_name' => 'Delete Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);

    }
}
