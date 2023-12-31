<?php

namespace App\Http\Requests\Admin\Forum;

use Illuminate\Foundation\Http\FormRequest;

class ForumStoreRequest extends FormRequest
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
            'type' => 'required|integer',
            'parentId' => '',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
