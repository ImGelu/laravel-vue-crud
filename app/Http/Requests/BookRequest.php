<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'pages' => ['required', 'integer', 'min:1', 'max:99999'],
            'language' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1', 'max:9999'],
            'authors' => ['required', 'array'],
            'authors.*' => ['required', 'exists:authors,id']
        ];
    }
}
