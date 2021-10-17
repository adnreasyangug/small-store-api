<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => [
                'required',
                'string',
            ],
            'lastName' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'string',
                'unique:users,phone',
            ],
            'email' => [
                'required',
                'string',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
            ],
            'passwordConfirm' => [
                'required',
                'string',
                'same:password'
            ],
        ];
    }
}
