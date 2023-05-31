<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker= Factory::create();

        $samiUser = User::find(3);
        $products = Product::active()->hasQuantity()->activeCategory()->inRandomOrder()->take(3)->get();
        $subtotalValue = $products->sum('price');
        $discountValue = $subtotalValue / 2;
        $shippingValue = 15.00;
        $taxValue = ($subtotalValue - $discountValue) * 0.15;
        $totalValue = $subtotalValue - $discountValue + $shippingValue + $taxValue;

        //create order
        $order = $samiUser->orders()->create([
            'ref_id' => Str::random(15),
            'user_address_id' => 1,
            'shipping_company_id' => 1,
            'payment_method_id' => 1,
            'subtotal' => $subtotalValue,
            'discount_code' => 'fiftyfifty',
            'discount' => $discountValue,
            'shipping' => $shippingValue,
            'tax' => $taxValue,
            'total' => $totalValue,
            'currency' => 'USD',
            'order_status' => Order::PAYMENT_COMPLETED,
        ]);
        //create order products
        $order->products()->attach($products->pluck('id')->toArray());
        //create order transactions
        $order->transactions()->createMany([
            [
                'transaction' => Order::NEW_ORDER,
                'transaction_number' => null,
                'payment_result' => null,
            ],
            [
                'transaction' => Order::PAYMENT_COMPLETED,
                'transaction_number' => Str::random(15),
                'payment_result' => 'success',
            ],
        ]);

        /* 
        * Create fake order for each user
        */
        User::where('id', '>', 3)->each(function (User $user) use($faker) {
            foreach(range(3,6) as $index){
                $products = Product::active()->hasQuantity()->activeCategory()->inRandomOrder()->take(3)->get();
                $subtotalValue = $products->sum('price');
                $discountValue = $subtotalValue / 2;
                $shippingValue = 15.00;
                $taxValue = ($subtotalValue - $discountValue) * 0.15;
                $totalValue = $subtotalValue - $discountValue + $shippingValue + $taxValue;
                $order_status = rand(0, 8);
                //create order
                $order = $user->orders()->create([
                    'ref_id' => Str::random(15),
                    'user_address_id' => $user->addresses()->first()->id,
                    'shipping_company_id' => 1,
                    'payment_method_id' => 1,
                    'subtotal' => $subtotalValue,
                    'discount_code' => 'fiftyfifty',
                    'discount' => $discountValue,
                    'shipping' => $shippingValue,
                    'tax' => $taxValue,
                    'total' => $totalValue,
                    'currency' => 'USD',
                    'order_status' => $order_status,
                    'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-6 months', 'now'),
                ]);
                //create order products
                $order->products()->attach($products->pluck('id')->toArray());
                //create order transactions
                $order->transactions()->createMany([
                    [
                        'transaction' => Order::NEW_ORDER,
                        'transaction_number' => null,
                        'payment_result' => null,
                    ],
                    [
                        'transaction' => $order_status,
                        'transaction_number' => Str::random(15),
                        'payment_result' => 'success',
                    ],
                ]);
            }
        });
    }
}
