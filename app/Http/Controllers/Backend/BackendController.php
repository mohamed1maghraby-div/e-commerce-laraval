<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\AdminInfoRequest;

class BackendController extends Controller
{
    public function login()
    {
        return view('backend.login'); 
    }
    
    public function forget_password()
    {
        return view('backend.forgot-password'); 
    }

    public function index()
    {
        return view('backend.index');
    }

    public function account_settings()
    {
        return view('backend.account_settings');
    }

    public function update_account_settings(AdminInfoRequest $request)
    {
        if($request->validated()){
            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['username'] = $request->username;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            if($request->password != ''){
                $data['password'] = bcrypt($request->password);
            }
            if($image = $request->file('user_image')){
                if(auth()->user()->user_image != null && File::exists('assets/users/' . auth()->user()->user_image)){
                    unlink('assets/users/'. auth()->user()->user_image);
                }
                $file_name = Str::slug($request->username). "." .$image->getClientOriginalExtension();
                $path = public_path('/assets/users/' . $file_name);
                Image::make($image->getRealPath())->resize(300, null, function($constraint){
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['user_image'] = $file_name;
            }

            auth()->user()->update($data);

            return redirect()->route('admin.account_settings')->with([
                'message' => 'Updated successfully',
                'alert_type' => 'success'
            ]);
        }
    }
    
    public function remove_image(Request $request)
    {
        if(!auth()->user()->ability('admin', 'delete_supervisors')){
            return redirect()->route('admin.index');
        }
        $user = auth()->user();
        if(File::exists('assets/users/' . $user->user_image)){
            unlink('assets/users/'. $user->user_image);

            $user->user_image = null;
            $user->save();
        }
        return true;
    }
}
