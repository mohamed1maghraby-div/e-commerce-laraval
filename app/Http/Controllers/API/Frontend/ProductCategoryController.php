<?php

namespace App\Http\Controllers\API\Frontend;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $product_categories = ProductCategory::whereStatus(1)->paginate(10);
        return response()->json($product_categories);
    }
}
