<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddressRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    'user_id' => 'required',
                    'default_address' => 'nullable',
                    'address_title' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'mobile' => 'required',
                    'address' => 'required',
                    'address2' => '',
                    'country_id' => 'required',
                    'state_id' => 'required',
                    'city_id' => 'required',
                    'zip_code' => 'required',
                    'po_box' => 'required',
                ];
            default: break;
        }
    }
}