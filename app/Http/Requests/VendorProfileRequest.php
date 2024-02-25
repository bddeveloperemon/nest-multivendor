<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorProfileRequest extends FormRequest
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
        return [
            'name'=> 'bail|required|string',
            'email'=> 'bail|required|email',
            'phone'=> 'bail|required|numeric|min:11',
            'address'=> 'bail|required|string',
            'image'=> 'bail|nullable|image|max:2048',
            'vendor_join'=> 'bail|nullable|string',
            'vendor_short_info'=> 'bail|nullable|string',
        ];
    }
}
