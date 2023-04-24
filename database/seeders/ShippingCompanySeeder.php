<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('shipping_companies')->truncate();
        DB::table('shipping_company_country')->truncate();

        Schema::enableForeignKeyConstraints();

        $sh01 = ShippingCompany::create([
            'name' => 'Aramex Inside',
            'code' => 'ARA',
            'description' => '8 - 10 days',
            'fast' => false,
            'cost' => '15.00',
            'status' => true,
        ]);
        $sh01->countries()->attach([194]);

        $sh02 = ShippingCompany::create([
            'name' => 'Aramex Inside speed shipping',
            'code' => 'ARA-SPD',
            'description' => '1 - 3 days',
            'fast' => true,
            'cost' => '25.00',
            'status' => true,
        ]);
        $sh02->countries()->attach([194]);

        $countriesIds = Country::where('id', '!=', 194)->pluck('id')->toArray();
        $sh03 = ShippingCompany::create([
            'name' => 'Aramex Outside',
            'code' => 'ARA-0',
            'description' => '15 - 20 days',
            'fast' => false,
            'cost' => '50.00',
            'status' => true,
        ]);
        $sh03->countries()->attach($countriesIds);

        $sh04 = ShippingCompany::create([
            'name' => 'Aramex Outside Speed shipping',
            'code' => 'ARA-0-SPD',
            'description' => '5 - 10 days',
            'fast' => true,
            'cost' => '80.00',
            'status' => true,
        ]);
        $sh04->countries()->attach($countriesIds);

    }
}
