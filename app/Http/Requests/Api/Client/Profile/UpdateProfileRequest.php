<?php

namespace App\Http\Requests\Api\Client\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'login' => 'min:6|max:64|unique:users',
            'firstName' => 'min:3|max:64|string',
            'lastName' => 'min:3|max:64|string',
            'email' => 'email|unique:users|min:7|max:64',
            'phone' => 'nullable|string|min:10|max:14',
        ];
    }
}
