<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\ProductCategoryRequest;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::withCount('products')
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.product_categories.index', compact('categories'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);
        return view('backend.product_categories.create', compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        $input['name'] = $request->input('name');
        $input['status'] = $request->input('status');
        $input['parent_id'] = $request->input('parent_id');

        if($image = $request->file('cover')){
            $file_name = Str::slug($request->name). "." .$image->getClientOriginalExtension();
            $path = public_path('/assets/product_categories/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }
        ProductCategory::create($input);

        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('backend.product_categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.product_categories.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
