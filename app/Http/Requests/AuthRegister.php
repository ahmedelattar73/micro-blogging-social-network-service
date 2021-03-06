<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|string|min:6|max:255',
            'image'      => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'birth_date' => 'required|date|date_format:Y-m-d|before:today'
        ];
    }

}
