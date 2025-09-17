<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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


        'brand'     => ['array', 'required_without:categories'],
        'brand.*'   => ['integer', 'exists:brands,id'],
        'category'   => ['array', 'required_without:brands'],
        'category.*' => ['integer', 'exists:categories,id'],

        ];
    }
}
