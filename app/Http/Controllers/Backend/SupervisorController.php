<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\SupervisorRequest;

class SupervisorController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user()->ability('admin', 'manage_supervisors, show_supervisors')){
            return redirect()->route('admin.index');
        }
        $supervisors = User::whereHas('roles', function($query){
            $query->where('name', 'supervisor');
        })
        ->when(\request()->keyword != null, function ($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null, function ($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.supervisors.index', compact('supervisors'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->ability('admin', 'create_supervisors')){
            return redirect()->route('admin.index');
        }
        $permissions = Permission::get(['id', 'display_name']);

        return view('backend.supervisors.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupervisorRequest $request)
    {
        if(!auth()->user()->ability('admin', 'create_supervisors')){
            return redirect()->route('admin.index');
        }

        $input['first_name'] = $request->input('first_name');
        $input['last_name'] = $request->input('last_name');
        $input['username'] = $request->input('username');
        $input['email'] = $request->input('email');
        $input['mobile'] = $request->input('mobile');
        $input['password'] = bcrypt($request->input('password'));
        $input['status'] = $request->input('status');

        if($image = $request->file('user_image')){
            $file_name = Str::slug($request->username). "." .$image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }
        $supervisor = User::create($input);
        $supervisor->markEmailAsVerified();
        $supervisor->attachRole(Role::whereName('supervisor')->first()->id);
        // add permissions

        if(isset($request->permissions) && count($request->permissions) > 0){
            $supervisor->permissions()->sync($request->permissions);
        }
        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Created successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $supervisor)
    {
        if(!auth()->user()->ability('admin', 'display_supervisors')){
            return redirect()->route('admin.index');
        }
        return view('backend.supervisors.show', compact('supervisor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $supervisor)
    {
        if(!auth()->user()->ability('admin', 'update_supervisors')){
            return redirect()->route('admin.index');
        }
        $permissions = Permission::get(['id', 'display_name']);
        $supervisorPermissions = User::whereUserId($supervisor->id)->pluck('permission_id')->toArray();

        return view('backend.supervisors.edit', compact('supervisor', 'permissions', 'supervisorPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupervisorRequest $request, User $supervisor)
    {
        if(!auth()->user()->ability('admin', 'update_supervisors')){
            return redirect()->route('admin.index');
        }
       
        
        $input['first_name'] = $request->input('first_name');
        $input['last_name'] = $request->input('last_name');
        $input['username'] = $request->input('username');
        $input['email'] = $request->input('email');
        $input['mobile'] = $request->input('mobile');
        if(trim($request->input('password')) != ''){
            $input['password'] = bcrypt($request->input('password'));
        }
        $input['status'] = $request->input('status');

        if($image = $request->file('user_image')){
            if($supervisor->user_image != null && File::exists('assets/users/' . $supervisor->user_image)){
                unlink('assets/users/'. $supervisor->user_image);
            }
            $file_name = Str::slug($request->username). "." .$image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }
        $supervisor->update($input);
        //update permissions
        if(isset($request->permissions) && count($request->permissions) > 0){
            $supervisor->permissions()->sync($request->permissions);
        }

        return redirect()->route('admin.supervisor.index')->with([
            'message' => 'Updated successfully',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $supervisor)
    {
        if(!auth()->user()->ability('admin', 'delete_supervisors')){
            return redirect()->route('admin.index');
        }
        if($supervisor->user_image != null && File::exists('assets/users/' . $supervisor->user_image)){
            unlink('assets/users/'. $supervisor->user_image);
        }

        $supervisor->delete();

        return redirect()->route('admin.supervisor.index')->with([
           'message' => 'Deleted successfully',
            'alert_type' =>'success'
        ]);
    }
    public function remove_image(Request $request)
    {
        if(!auth()->user()->ability('admin', 'delete_supervisors')){
            return redirect()->route('admin.index');
        }
        $supervisor = User::findOrFail($request->supervisor_id);
        if($supervisor->user_image != null && File::exists('assets/users/' . $supervisor->user_image)){
            unlink('assets/users/'. $supervisor->user_image);

            $supervisor->user_image = null;
            $supervisor->save();
        }
        return true;
    }
}
