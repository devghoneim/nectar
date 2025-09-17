<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'zone_id'=>['required','int','exists:zones,id'],
            'area_id'=>['required','int','exists:areas,id'],
        ];
    }
}
