<?php

namespace App\Http\Requests\OutgoingLetter;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'registarion_date' => 'date',
            'destination_id' => 'integer',
            'document_name_id' => 'integer',
            'document_subject' => 'string',
            'performer_id' => 'integer',
            'signer_id' => 'integer',
            'incoming_number' => 'integer',
            'classificator_id' => 'integer'
        ];
    }
}
