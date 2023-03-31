<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductReviewRequest extends FormRequest
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
                    //
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' =>'required|max:255',
                    'user_id' =>'nullable',
                    'product_id' =>'required',
                    'email' =>'required|email',
                    'title' =>'required',
                    'message' =>'required',
                    'rating' =>'required|numeric',
                    'status' =>'required',
                ];
            default: break;
        }
    }
}
