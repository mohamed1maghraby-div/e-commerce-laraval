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
    public function product($slug)
    {
        $product = Product::with('media', 'category', 'tags', 'reviews')->withAvg('reviews', 'rating')->whereSlug($slug)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        $relatedProducts = Product::with('firstMedia')->whereHas('category', function($query) use ($product) {
            $query->whereId($product->product_category_id);
            $query->whereStatus(true);
        })->inRandomOrder()->active()->HasQuantity()->take(4)->get();
        return view('frontend.product', compact('product', 'relatedProducts'));
    }
    public function cart()
    {
        return view('frontend.cart');
    }
    public function checkout()
    {
        return view('frontend.checkout');
    }
    public function shop()
    {
        return view('frontend.shop');
    }
}
