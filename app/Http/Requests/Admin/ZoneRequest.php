<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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

    public function validationData(): array
    {
    return array_merge($this->all(), $this->route()?->parameters() ?? []);
    }

    public function onCreate()
    {
          return [
             'name'=>['required','array'],
             'name.ar'=>['required', 'string','max:255'],
             'name.en'=>['required', 'string','max:255'],

        ];

    }


    public function onUpdate()
    {

          return [
            'id' => ['int','exists:zones,id'],
             'name'=>['sometimes','required','array'],
             'name.ar'=>['sometimes','required', 'string','max:255'],
             'name.en'=>['sometimes','required', 'string','max:255'],

        ];
    }

    public function rules(): array
    {
        
       return $this->isMethod('PUT') || $this->isMethod('PATCH') ? $this->onUpdate() : $this->onCreate();
    }
}
