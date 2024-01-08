<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()){
            case 'POST':
                return [
                    'name' =>'required|max:255|unique:brands',
                    'image' =>'required|mimes:png,jpg,jpeg|max:2000',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' =>'required|max:255|unique:brands,name,'. $this->route()->brands->id,
                    'image' =>'nullable|mimes:png,jpg,jpeg|max:2000',
                ];
            default: break;
        }
    }
}
