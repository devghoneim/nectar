<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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

    public function onCreate()
    {

        return [
            
            'category_id'=>['required','int','exists:categories,id'],
            'name.ar'=>['required','string','max:20'],
            'name.en'=>['required','string','max:20'],


        ];

    }

    public function onUpdate()
    {
         return [
            'name.ar'=>['required','string','max:20'],
            'name.en'=>['required','string','max:20'],


        ];
    }

    public function rules(): array
    {
        return $this->isMethod('put') || $this->isMethod('patch') ? $this->onUpdate() : $this->onCreate();
    }
}
