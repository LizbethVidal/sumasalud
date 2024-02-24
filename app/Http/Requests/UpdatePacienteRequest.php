<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
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
            'name' => 'required',
            'dni' => 'required',
            'email' => 'required',
            'movil' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'dni.required' => 'El DNI es obligatorio',
            'dni.unique' => 'El DNI ya está en uso',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya está en uso',
            'movil.required' => 'El móvil es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
        ];
    }
}
