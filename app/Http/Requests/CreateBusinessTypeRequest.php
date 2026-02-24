<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessTypeRequest extends FormRequest
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
            'account_type_id' => 'required|uuid',
            'business_type_id' => 'nullable|uuid',
            'business_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'business_category' => 'nullable|string|max:255',
            'business_type' => 'nullable|string|max:255',
            'business_email' => 'nullable|email|max:255',
            'business_facebook_url' => 'nullable|url|max:255',
            'business_twitter_url' => 'nullable|url|max:255',
            'business_instagram_url' => 'nullable|url|max:255',
            'business_whatsapp_number' => 'nullable|string|max:20',
            'business_contact' => 'nullable|string|max:255', 
            'tax_identification_number' => 'nullable|string|max:255',
            'business_description' => 'nullable|string',
        ];
    }
}
