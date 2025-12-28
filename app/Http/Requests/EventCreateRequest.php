<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest
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
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'required|string|max:500',
            'start_datetime' => 'required|date|after:now',
            'end_datetime' => 'required|date|after:start_datetime',
            'duration' => 'required|integer|min:1',
            'status' => 'in:DRAFT,PUBLISHED,CANCELLED,COMPLETED',
            'max_capacity' => 'nullable|integer|min:1',
            'expected_attendees' => 'nullable|integer|min:0',
            'sales_target' => 'nullable|numeric|min:0',
            'early_bird_deadline' => 'nullable|date|before:start_datetime',
            'refund_policy' => 'nullable|string',
        ];
    }
}
