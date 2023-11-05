<?php

namespace App\Http\Requests\Api\Client\Topic;

use Illuminate\Foundation\Http\FormRequest;

class TopicUpdateRequest extends FormRequest
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
            'title' => 'max:255|string',
            'forumId' => 'integer|exists:forums,id',
            'content' => 'string',
            'tags' => '',
            'images' => '',
            'files' => '',
        ];
    }
}
