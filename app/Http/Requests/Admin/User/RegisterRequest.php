<?php

namespace App\Http\Requests\Admin\User;

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
            'login' => 'required|min:3|max:64|unique:users',
            'firstName' => 'min:3|max:64|string|nullable',
            'lastName' => 'min:3|max:64|string|nullable',
            'email' => 'required|email|unique:users|min:7|max:64',
            'roleId' => 'integer|exists:roles,id|nullable',
        ];
    }
}
