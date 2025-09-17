<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name.ar'=>['required','string','max:255'],
            'name.en'=>['required','string','max:255'],
            'description.ar'=>['required','string','max:255'],
            'description.en'=>['required','string','max:255'],
            'brand_id'=>['required','exists:brands,id'],
            'cat_id'=>['required','exists:categories,id'],
            'sub_cat_id'=>['required','exists:sub_categories,id'],
            'main_image'=>['required','mimes:jpg,jpeg,png','max:4096'],
            'image'=>['required','array'],
            'image.*'=>['required','mimes:png,jpg,jpeg','max:4096'],
            'price'=>['required','integer'],
            'unit_value'=>['required','integer'],
            'quantity'=>['required','integer'],
            'unit_type'=>['required','string','in:pcs,l,gm'],
            'offer'=>['integer','min:0','max:100'],
            'label'=>['array'],
            'label.*'=>['exists:labels,id'],
        ];
    }
}
