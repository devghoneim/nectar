<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'bail|required|string|min:2|max:50',
            'email' => ['bail','required','email','max:255',Rule::unique('users','email')->whereNull('deleted_at')],
            'phone' => ['bail','required','string','regex:/^((\+|00|)9665|0?5)([013-9][0-9]{7})$/','unique:users,phone'], // saudi arabia format
            'password'=>'required|min:8|max:150|confirmed'
        ];

    }
}
