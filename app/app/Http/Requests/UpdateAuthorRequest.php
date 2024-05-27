<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change this based on your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:255|unique:authors,fullname,' . $this->author->id,
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
            'fullname.required' => 'The author name field is required.',
            'fullname.string' => 'The author name field must be a string.',
            'fullname.max' => 'The author name field must not exceed 255 characters.',
            'fullname.unique' => 'The author name has already been taken.',
        ];
    }
}
