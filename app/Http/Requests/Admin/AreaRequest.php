<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function validationData()
    {
        return array_merge($this->all(),$this->route()?->parameters() ?? []);
    }

    public function onCreate()
    {
        return [
            'zone_id'=>['required','integer','exists:zones,id'],
             'name.ar'=>['required', 'string','max:255'],
             'name.en'=>['required', 'string','max:255'],

        ];
    }

    public function onUpdate()
    {
        return [
            'zone_id'=>['sometimes','required','integer','exists:zones,id'],
             'name.ar'=>['sometimes','required', 'string','max:255'],
             'name.en'=>['sometimes','required', 'string','max:255'],
        ];
    }
    public function rules(): array
    {
       return $this->isMethod('put') || $this->isMethod('patch') ? $this->onUpdate() : $this->onCreate();

            
        
    }
}
