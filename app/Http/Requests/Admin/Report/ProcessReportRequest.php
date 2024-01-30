<?php

namespace App\Http\Requests\Admin\Report;

use Illuminate\Foundation\Http\FormRequest;

class ProcessReportRequest extends FormRequest
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
            'message' => 'required|string',
            'reasonId' => 'required|integer|exists:report_reason_types,id',
            'action' => 'required|integer',
            'warn' => 'required|string',
            'totalDaysBan' => 'integer|nullable|min:5|max:30',
        ];
    }
}
