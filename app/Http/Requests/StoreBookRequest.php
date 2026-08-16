<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'author' => 'required|min:3|max:255',
            //'image' => 'nullable|min:3|max:255', // это обычный текст
            'image' => 'nullable|url|min:3|max:255', // это url
            'description' => 'required|min:3|max:65535'
        ];
    }
}
