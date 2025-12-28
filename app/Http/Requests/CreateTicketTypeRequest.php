<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketTypeRequest extends FormRequest
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
            'ticket_type_id' => 'required|uuid',
            'event_id' => 'required|uuid',
            'price' => 'required|numeric|min:0',
            'quantity_available' => 'required|integer|min:1',
            'sales_start_datetime' => 'required|date|after:now',
            'sales_end_datetime' => 'required|date|after:sales_start_datetime',
        ];
    }
}
