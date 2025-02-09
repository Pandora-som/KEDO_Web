<?php

namespace App\Http\Requests\IncomingLetter;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'registration_date' => 'date',
            'document_from_id' => 'integer',
            'document_name_id' => 'integer',
            'document_number' => 'integer',
            'document_date' => 'date',
            'document_subject' => 'string',
            'resolution' => 'string',
            'performer_id' => 'integer',
            'deadline' => 'date',
            'status_id' => 'integer',
            'classificator_id' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date'
        ];
    }
}
