<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'min:9'],
            'date_of_recruit' => ['required', 'date'],
            'specialty' => ['required', 'string', 'max:255'],
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Student Name',
            'email' => 'Student Email',
            'phone'  => 'phone',
            'date_of_recruit' => 'recruitedOn',
            'specialty'  => 'specialty'

        ];
    }
}
