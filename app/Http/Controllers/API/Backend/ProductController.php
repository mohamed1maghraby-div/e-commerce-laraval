<?php

namespace App\Http\Controllers\API\Backend;

use App\Models\Tag;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\ProductRequest;

class ProductController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* if(!auth()->user()->ability('admin', 'manage_products, show_products')){
            return redirect()->route('admin.index');
        } */

        $products = Product::with('category', 'tags', 'firstMedia')->withAvg('reviews', 'rating')
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'asc')
        /* ->get(); */
        ->paginate(\request()->limit_by ?? 10);
        
        return response()->json($products);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* if(!auth()->user()->ability('admin', 'create_products')){
            return redirect()->route('admin.index');
        } */
        $categories = ProductCategory::whereStatus(1)->get(['id', 'name']);
        $tags = Tag::whereStatus(1)->get(['id', 'name']);

        return response()->json([$categories, $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        /* {
            "name": "test name",
            "description": "test desc",
            "quantity": "10",
            "price": "100",
            "product_category_id": "1",
            "brand": "1",
            "status": "1",
            "featured": "1",
            "availableColors": [
                "#808900",
                "#653294",
                "#c45100"
            ],
            "subcategories": [
                "3",
                "5"
            ],
            "images": [
                {}
            ]
        } */
        return response()->json($request->all());
        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['featured'] = $request->featured;
        $input['status'] = $request->status;
        
        $product = Product::create($input);
        $product->tags()->attach($request->tags);
        
        if($request->images && count($request->images)){
            $i=1;
            foreach($request->images as $image){
                $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('/assets/products/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function($constraint){
                    $constraint->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i
                ]);

                $i++;
            }
        }

        /* return redirect()->route('admin.products.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success',
        ]); */

        return $this->returnSuccessMessage('Created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /* if(!auth()->user()->ability('admin', 'display_products')){
            return redirect()->route('admin.index');
        } */
        $product = Product::with('tags', 'media', 'category')->withAggregate('category','name')->withAvg('reviews', 'rating')->find($id);
        return response()->json($product);

        //return view('backend.product_categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        /* if(!auth()->user()->ability('admin', 'update_products')){
            return redirect()->route('admin.index');
        }
 */
        $categories = ProductCategory::whereStatus(1)->get(['id', 'name']);
        $tags = Tag::whereStatus(1)->get(['id', 'name']);
        
        return view('backend.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        /* if(!auth()->user()->ability('admin', 'update_products')){
            return redirect()->route('admin.index');
        } */

        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['price'] = $request->price;
        $input['quantity'] = $request->quantity;
        $input['product_category_id'] = $request->product_category_id;
        $input['featured'] = $request->featured;
        $input['status'] = $request->status;

        $product->update($input);
        $product->tags()->sync($request->tags);

        if($request->images && count($request->images)){
            $i = $product->media()->count() + 1;
            /* foreach($request->images as $image){
                $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_size = $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('/assets/products/' . $file_name);
                Image::make($image->getRealPath())->resize(500, null, function($constraint){
                    $constraint->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                    'file_status' => true,
                    'file_sort' => $i
                ]);

                $i++;
            } */
        }

        return $this->returnSuccessMessage('Created successfully', 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        
        if($product->media()->count() > 0){
            foreach($product->media as $media){
                if(File::exists('assets/products/'. $media->file_name)){
                    unlink('assets/products/'. $media->file_name);
                }
                $media->delete();
            }
        }
        $product->delete();

        return $this->returnSuccessMessage('Deleted successfully', 201);
    }
    public function remove_image(Request $request)
    {
        if(!auth()->user()->ability('admin', 'delete_products')){
            return redirect()->route('admin.index');
        }
        $product = Product::findOrFail($request->product_id);
        $image = $product->media()->whereId($request->image_id)->first();
        if(File::exists('assets/products/' . $image->file_name)){
            unlink('assets/products/' . $image->file_name);
        }
        $image->delete();
        
        return true;
    }
}
