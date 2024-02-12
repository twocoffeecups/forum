<?php

namespace App\Http\Requests\Client\Report;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'reasonId' => 'integer|exists:report_reason_types,id',
            'object' => 'string',
            'topicId' => 'nullable|integer|exists:topics,id',
            'postId' => 'nullable|integer|exists:posts,id',
            'userId' => 'integer|exists:users,id',
            'message' => 'nullable|string'
        ];
    }
}
