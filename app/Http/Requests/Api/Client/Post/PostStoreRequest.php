<?php

namespace App\Http\Requests\Api\Client\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'topicId' => 'required|integer|exists:topics,id',
            'message' => 'required|string',
            'replyId' => 'integer|exists:posts,id',
            'userId' => 'exists:users,id',
            'files' => '',
            'images' => '',
        ];
    }
}
