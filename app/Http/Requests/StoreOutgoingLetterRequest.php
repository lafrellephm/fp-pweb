<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOutgoingLetterRequest extends FormRequest
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
        return [
            'letter_type'    => 'required|in:recommendation,active_certificate,assignment',
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
}
