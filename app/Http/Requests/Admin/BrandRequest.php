<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name.en'=>['required','string'],
            'name.ar'=>['required','string'],
            'description.ar'=>['required','string'],
            'description.en'=>['required','string'],
            'image'=>['required','image','mimes:jpg,jpeg,png,webp', 'max:2048']
        ];
    }
}
