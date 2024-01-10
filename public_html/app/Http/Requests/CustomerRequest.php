<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dni' => 'required|numeric',
            'id_reg' => 'required|numeric|exists:regions,id_reg',
            'id_com' => 'required|numeric|exists:communes,id_com',
            'email' => 'required|email',
            'name' => 'required',
            'last_name' => 'required',
            'adress' => 'required',
        ];
    }
}