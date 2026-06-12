<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIncomingLetterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
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
}
