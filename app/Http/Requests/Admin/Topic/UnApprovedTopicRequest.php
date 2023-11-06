<?php

namespace App\Http\Requests\Admin\Topic;

use Illuminate\Foundation\Http\FormRequest;

class UnApprovedTopicRequest extends FormRequest
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
            'topicId' => 'integer|exists:topics,id',
            'reasonId' => 'integer|exists:un_approved_reasons,id',
            //'userId' => 'required|integer',
            'message' => 'string'
        ];
    }
}
