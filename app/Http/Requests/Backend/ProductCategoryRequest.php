<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':
                return [
                    'name' =>'required|max:255|unique:product_categories',
                    'status' =>'required',
                    'parent_id' =>'nullable',
                    'cover' =>'required|mimes:png,jpg,jpeg|max:2000',
                ];
            case 'PUT':
                return [
                    'name' =>'required',
                ];
            case 'PATCH':
                return [
                    'name' =>'required',
                ];
            default: break;
        }
    }
}
