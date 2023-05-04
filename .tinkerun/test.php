<?php 

use App\Models\Product;
use App\Models\ProductCategory;

$product_categories = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
$featured_products = Product::with('firstMedia')
->inRandomOrder()
->Featured()
->active()
->HasQuantity()
->ActiveCategory()
->take(8)
->get();
