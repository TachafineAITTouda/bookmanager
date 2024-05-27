<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'format' => 'required|string|in:csv,xml',
            'fields' => 'required|string|in:author,title,all',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'format.required' => 'The format field is required.',
            'format.string' => 'The format field must be a string.',
            'format.in' => 'The selected format is invalid.',
            'fields.required' => 'The fields field is required.',
            'fields.string' => 'The fields field must be a string.',
            'fields.in' => 'The selected fields is invalid.',
        ];
    }
}
