<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'synopsis' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ' A title is required',
            'title.max' => 'A title max length is 255 characters',
            'synopsis.required' => 'A synopsis is required'
        ];
    }
}
