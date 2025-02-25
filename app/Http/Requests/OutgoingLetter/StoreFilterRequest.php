<?php

namespace App\Http\Requests\OutgoingLetter;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilterRequest extends FormRequest
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
            'destination' => 'required|string',
            'document_name' => 'required|string',
            'document_subject' => 'required|string',
            'performer' => 'required|string',
            'signer' => 'required|string',
            'incoming_number' => 'required|integer',
            'classificator_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'registration_date.required' => 'Поле обязательно к заполнению!',
            'destination.required' => 'Поле обязательно к заполнению!',
            'document_name.required' => 'Поле обязательно к заполнению!',
            'document_subject.required' => 'Поле обязательно к заполнению!',
            'performer.required' => 'Поле обязательно к заполнению!',
            'signer.required' => 'Поле обязательно к заполнению!',

            'incoming_number.required' => 'Поле обязательно к заполнению!',
            'incoming_number.integer' => 'Номер должен содержать только целое число!',

            'classificator_id.required' => 'Поле обязательно к заполнению!',
        ];
    }
}
