<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        if(!auth()->user()->ability('admin', 'manage_tags, show_tags')){
            return redirect()->route('admin.index');
        }
        $tags = Tag::with('products')
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.tags.index', compact('tags'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->ability('admin', 'create_tags')){
            return redirect()->route('admin.index');
        }
        return view('backend.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        if(!auth()->user()->ability('admin', 'create_tags')){
            return redirect()->route('admin.index');
        }

        Tag::create($request->validated());

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->ability('admin', 'display_tags')){
            return redirect()->route('admin.index');
        }
        return view('backend.tags.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        if(!auth()->user()->ability('admin', 'update_tags')){
            return redirect()->route('admin.index');
        }

        return view('backend.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        if(!auth()->user()->ability('admin', 'update_tags')){
            return redirect()->route('admin.index');
        }
        $input['name'] = $request->input('name');
        $input['slug'] = null;
        $input['status'] = $request->input('status');

        $tag->update($input);

        return redirect()->route('admin.tags.index')->with([
            'message' => 'Updated successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if(!auth()->user()->ability('admin', 'delete_tags')){
            return redirect()->route('admin.index');
        }
        $tag->delete();
        return redirect()->route('admin.tags.index')->with([
           'message' => 'Deleted successfully',
            'alert_type' =>'success'
        ]);
    }
}
