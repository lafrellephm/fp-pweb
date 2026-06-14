<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterFormRequest extends FormRequest
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
     */
    public function rules(): array
    {
        if ($this->routeIs('*.incoming-letters.*')) {
            return [
                'letter_number' => 'required|string|max:50',
                'letter_date'   => 'required|date',
                'received_date' => 'required|date',
                'sender'        => 'required|string|max:100',
                'letter_type'   => 'required|in:invitation,announcement',
                'urgency'       => 'required|in:normal,urgent,critical',
                'subject'       => 'required|string|max:255',
                'file_path'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ];
        }

        if ($this->routeIs('*.outgoing-letters.*')) {
            return [
                'letter_type'    => 'required|in:recommendation,active_certificate,assignment',
                'urgency'        => 'required|in:normal,urgent,critical',
                'related_name'   => 'required|string|max:100',
                'purpose'        => 'required|string|max:255',
                'addressed_to'   => 'required|string|max:100',
                'letter_body'    => 'required|string',
                'event_name'     => 'required_if:letter_type,assignment|nullable|string|max:100',
                'event_date'     => 'required_if:letter_type,assignment|nullable|date',
                'event_location' => 'required_if:letter_type,assignment|nullable|string|max:100',
                'file_path'      => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ];
        }

        return [];
    }
}
