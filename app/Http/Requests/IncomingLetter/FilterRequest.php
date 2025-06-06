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
            'deadline' => 'date',
            'status_id' => 'integer',
            'classificator_id' => 'array',
            'classificator_id.*' => 'integer',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'lettersGroup' => '',
            'find' => 'nullable|string'
        ];
    }
}
