<?php

namespace App\Http\Requests\IncomingLetter;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestFilter extends FormRequest
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
            'registration_date' => 'required|date',
            'document_from' => 'required|string',
            'document_name' => 'required|string',
            'document_number' => 'required|integer',
            'document_date' => 'required|date',
            'document_subject' => 'required|string',
            'resolution' => 'required|string',
            'performer' => 'required|string',
            'deadline' => 'required|date|after_or_equal:document_date',
            'status_id' => 'required|integer',
            'classificator_id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'registration_date.required' => 'Поле обязательно к заполнению!',
            'document_from.required' => 'Поле обязательно к заполнению!',
            'document_name.required' => 'Поле обязательно к заполнению!',

            'document_number.required' => 'Поле обязательно к заполнению!',
            'document_number.integer' => 'Номер должен содержать только числа!',

            'document_date.required' => 'Поле обязательно к заполнению!',
            'document_subject.required' => 'Поле обязательно к заполнению!',
            'resolution.required' => 'Поле обязательно к заполнению!',
            'performer.required' => 'Поле обязательно к заполнению!',
            'deadline.required' => 'Поле обязательно к заполнению!',

            'deadline.after_or_equal' => 'Срок исполнения не может быть раньше даты документа!',
        ];
    }
}
