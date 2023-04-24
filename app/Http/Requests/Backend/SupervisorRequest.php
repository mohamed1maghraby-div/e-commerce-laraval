<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route()->supervisor->id;
        switch ($this->method()){
            case 'POST':
                return [
                    'first_name' =>'required',
                    'last_name' =>'required',
                    'username' =>'required|max:20|unique:users',
                    'email' =>'required|email|max:255|unique:users',
                    'mobile' =>'required|numeric|unique:users',
                    'status' =>'required',
                    'password' =>'required|min:8',
                    'user_image' =>'nullable|mimes:jpg,jpeg,png,svg|max:20000',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'first_name' =>'required',
                    'last_name' =>'required',
                    'username' =>'required|max:20|unique:users,username,' . $id,
                    'email' =>'required|email|max:255|unique:users,email,' . $id,
                    'mobile' =>'required|numeric|unique:users,mobile,' . $id,
                    'status' =>'required',
                    'password' =>'required|min:8',
                    'user_image' =>'nullable|mimes:jpg,jpeg,png,svg|max:20000',
                ];
            default: break;
        }
    }
}