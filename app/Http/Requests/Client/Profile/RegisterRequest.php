<?php

namespace App\Http\Requests\Client\Profile;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => 'required|min:6|max:64|unique:users',
            'name' => 'required|min:6|max:128|string',
            'email' => 'required|email|unique:users|min:7|max:64',
            'phone' => 'nullable|string',
            'password' => 'required|min:8|max:64',
            'passwordConfirmation' => 'required|min:8|max:64|same:password'
        ];
    }
}
