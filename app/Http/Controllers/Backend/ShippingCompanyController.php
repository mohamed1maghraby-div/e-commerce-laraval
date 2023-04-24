<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShippingCompanyRequest;
use App\Models\Country;
use App\Models\ShippingCompany;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{
    public function index()
    {
        if(!auth()->user()->ability('admin', 'manage_shipping_companies, show_shipping_companies')){
            return redirect()->route('admin.index');
        }
        $shipping_companies = ShippingCompany::withCount('countries')
        ->when(\request()->keyword != '', function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != '', function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.shipping_companies.index', compact('shipping_companies'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->ability('admin', 'create_shipping_companies')){
            return redirect()->route('admin.index');
        }
        $countries = Country::orderBy('id', 'asc')->get(['id', 'name']);
        return view('backend.shipping_companies.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingCompanyRequest $request)
    {
        if(!auth()->user()->ability('admin', 'create_shipping_companies')){
            return redirect()->route('admin.index');
        }
        if($request->validated()){
            $shipping_company = ShippingCompany::create($request->except('countries', '_token', 'submit'));
            $shipping_company->countries()->attach(array_values($request->countries));
    
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Created successfully',
                'alert_type' => 'success'
            ]);
        }else{
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Somthing went wrong',
                'alert_type' => 'danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->ability('admin', 'display_shipping_companies')){
            return redirect()->route('admin.index');
        }
        return view('backend.shipping_companies.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingCompany $shipping_company)
    {
        if(!auth()->user()->ability('admin', 'update_shipping_companies')){
            return redirect()->route('admin.index');
        }

        $shipping_company->with('countries');
        $countries = Country::get(['id', 'name']);

        return view('backend.shipping_companies.edit', compact('shipping_company', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingCompanyRequest $request, ShippingCompany $shipping_company)
    {
        if(!auth()->user()->ability('admin', 'update_shipping_companies')){
            return redirect()->route('admin.index');
        }

        if($request->validated()){
            $shipping_company->update($request->except('countries', '_token', 'submit'));
            $shipping_company->countries()->sync(array_values($request->countries));
    
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Updated successfully',
                'alert_type' => 'success'
            ]);
        }else{
            return redirect()->route('admin.shipping_companies.index')->with([
                'message' => 'Somthing went wrong',
                'alert_type' => 'danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingCompany $shipping_company)
    {
        if(!auth()->user()->ability('admin', 'delete_shipping_companies')){
            return redirect()->route('admin.index');
        }
        $shipping_company->delete();
        return redirect()->route('admin.shipping_companies.index')->with([
           'message' => 'Deleted successfully',
            'alert_type' =>'success'
        ]);
    }
}
