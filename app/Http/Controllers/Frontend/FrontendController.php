<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
        $featured_products = Product::with('firstMedia')
        ->inRandomOrder()
        ->Featured()
        ->active()
        ->HasQuantity()
        ->ActiveCategory()
        ->take(8)
        ->get();
        return view('frontend.index', compact('product_categories', 'featured_products'));
    }
    public function cart()
    {
        return view('frontend.cart');
    }
    public function checkout()
    {
        return view('frontend.checkout');
    }
    public function product()
    {
        return view('frontend.product');
    }
    public function shop()
    {
        return view('frontend.shop');
    }
}
