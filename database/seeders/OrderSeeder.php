<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
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
        $order->transactions()->createMany(
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
        );
    }
}
