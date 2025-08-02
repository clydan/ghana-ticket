<?php

namespace App\Http\Requests;

use App\Rules\Lowercase;
use App\Rules\Number;
use App\Rules\Symbol;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',

            // We split password requirements into multiple named rules
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                new Lowercase,
                new Uppercase,
                new Number,
                new Symbol,
            ],

            'password_confirmation' => 'required',
        ];
    }
}
