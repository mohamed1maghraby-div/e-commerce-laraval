<?php

namespace App\Http\Controllers\Backend;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StateRequest;

class StateController extends Controller
{
    public function index()
    {
        if(!auth()->user()->ability('admin', 'manage_states, show_states')){
            return redirect()->route('admin.index');
        }
        $states = State::with('cities')
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.states.index', compact('states'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->ability('admin', 'create_states')){
            return redirect()->route('admin.index');
        }
        $countries = Country::get(['id', 'name']);
        return view('backend.states.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        if(!auth()->user()->ability('admin', 'create_states')){
            return redirect()->route('admin.index');
        }

        State::create($request->validated());

        return redirect()->route('admin.states.index')->with([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        if(!auth()->user()->ability('admin', 'display_states')){
            return redirect()->route('admin.index');
        }
        return view('backend.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        if(!auth()->user()->ability('admin', 'update_states')){
            return redirect()->route('admin.index');
        }
        $countries = Country::get(['id', 'name']);

        return view('backend.states.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, State $state)
    {
        if(!auth()->user()->ability('admin', 'update_states')){
            return redirect()->route('admin.index');
        }

        $state->update($request->validated());

        return redirect()->route('admin.states.index')->with([
            'message' => 'Updated successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        if(!auth()->user()->ability('admin', 'delete_states')){
            return redirect()->route('admin.index');
        }
        $state->delete();
        return redirect()->route('admin.states.index')->with([
           'message' => 'Deleted successfully',
            'alert_type' =>'success'
        ]);
    }
}
