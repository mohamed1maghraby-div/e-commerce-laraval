<?php

namespace App\Http\Controllers\API\Backend;

use Illuminate\Support\Str;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        if(!auth()->user()->ability('admin', 'manage_product_categories, show_product_categories')){
            return redirect()->route('admin.index');
        }
        $categories = ProductCategory::withCount('products')
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        /* return view('backend.product_categories.index', compact('categories')); */
        return response()->json($categories);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->ability('admin', 'create_product_categories')){
            return redirect()->route('admin.index');
        }
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);
        /* return view('backend.product_categories.create', compact('main_categories')); */
        return response()->json($main_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        /* if(!auth()->user()->ability('admin', 'create_product_categories')){
            return redirect()->route('admin.index');
        } */
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

        /* return redirect()->route('admin.product_categories.index')->with([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]); */

        /* return response()->json([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]); */

        return $this->returnSuccessMessage('Created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->ability('admin', 'display_product_categories')){
            return redirect()->route('admin.index');
        }
        return view('backend.product_categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin', 'update_product_categories')){
            return redirect()->route('admin.index');
        }
        $main_categories = ProductCategory::whereNull('parent_id')->get(['id', 'name']);
        return view('backend.product_categories.edit', compact('main_categories', 'productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin', 'update_product_categories')){
            return redirect()->route('admin.index');
        }
        $input['name'] = $request->input('name');
        $input['slug'] = null;
        $input['status'] = $request->input('status');
        $input['parent_id'] = $request->input('parent_id');

        if($image = $request->file('cover')){
            if($productCategory->cover != null && File::exists('assets/product_categories/' . $productCategory->cover)){
                unlink('assets/product_categories/'. $productCategory->cover);
            }
            $file_name = Str::slug($request->name). "." .$image->getClientOriginalExtension();
            $path = public_path('/assets/product_categories/' . $file_name);
            Image::make($image->getRealPath())->resize(500, null, function($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['cover'] = $file_name;
        }
        $productCategory->update($input);

        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'Updated successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if(!auth()->user()->ability('admin', 'delete_product_categories')){
            return redirect()->route('admin.index');
        }
        if(File::exists('assets/product_categories/' . $productCategory->cover)){
            unlink('assets/product_categories/'. $productCategory->cover);
        }
        $productCategory->delete();
        return redirect()->route('admin.product_categories.index')->with([
           'message' => 'Deleted successfully',
            'alert_type' =>'success'
        ]);
    }
    public function remove_image(Request $request)
    {
        if(!auth()->user()->ability('admin', 'delete_product_categories')){
            return redirect()->route('admin.index');
        }
        $category = ProductCategory::findOrFail($request->product_category_id);
        if(File::exists('assets/product_categories/' . $category->cover)){
            unlink('assets/product_categories/'. $category->cover);
            
            $category->cover = null;
            $category->save();
        }
        return true;
    }
}
