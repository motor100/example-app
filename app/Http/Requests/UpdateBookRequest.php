<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            /**
             * sometimes
             * Если это поле присутствует в запросе, то к нему применяются правила required, min, max.
             * Но если этого поля в запросе вообще нет — просто проигнорируй его
             * 
             * До этого я писал только required или nullable
             * 
             * Это позволяет API поддерживать метод PATCH (частичное обновление, когда клиент присылает для изменения только одно поле, например, только title
             */
            'title' => 'sometimes|required|min:3|max:255',
            'author' => 'sometimes|required|min:3|max:255',
            //'image' => 'nullable|min:3|max:255', // это обычный текст
            'image' => 'nullable|url|min:3|max:255', // это url
            'description' => 'sometimes|required|min:3|max:65535'
        ];
    }
}
