<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'username' => 'bail|required|string|max:255',
            'name'      => 'bail|required|string|max:255',
            'email'     => 'bail|required|email|unique:users',
            'phone'     => 'bail|required|numeric',
            'address'   => 'bail|required',
            'password'  => 'bail|required|string',
        ];
    }
}
