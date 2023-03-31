<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductReviewRequest;

class ProductReviewController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->ability('admin', 'manage_product_reviews, show_product_reviews')){
            return redirect()->route('admin.index');
        }
        $reviews = ProductReview::with('product', 'user')
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.product_reviews.index', compact('reviews'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->ability('admin', 'create_product_reviews')){
            return redirect()->route('admin.index');
        }
        
        return view('backend.product_reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!auth()->user()->ability('admin', 'create_product_reviews')){
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductReview $productReview)
    {
        if(!auth()->user()->ability('admin', 'display_product_reviews')){
            return redirect()->route('admin.index');
        }
        return view('backend.product_reviews.show', compact('productReview'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductReview $productReview)
    {
        if(!auth()->user()->ability('admin', 'update_product_reviews')){
            return redirect()->route('admin.index');
        }
        
        return view('backend.product_reviews.edit', compact('productReview'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductReviewRequest $request, ProductReview $productReview)
    {
        if(!auth()->user()->ability('admin', 'update_product_reviews')){
            return redirect()->route('admin.index');
        }

        $productReview->update($request->validated());

        return redirect()->route('admin.product_reviews.index')->with([
            'message' => 'Updated successfully',
            'alert_type' => 'success'
        ]);
    }

    public function destroy(ProductReview $productReview)
    {
        if(!auth()->user()->ability('admin', 'delete_product_reviews')){
            return redirect()->route('admin.index');
        }
        
        $productReview->delete();

        return redirect()->route('admin.product_reviews.index')->with([
           'message' => 'Deleted successfully',
            'alert_type' =>'success'
        ]);
    }

}
