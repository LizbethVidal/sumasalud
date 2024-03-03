<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicoRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'movil' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'especialidad_id' => 'required|string|max:255',
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
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'dni.required' => 'El DNI es obligatorio',
            'dni.string' => 'El DNI debe ser una cadena de caracteres',
            'dni.max' => 'El DNI no puede superar los 255 caracteres',
            'movil.required' => 'El móvil es obligatorio',
            'movil.string' => 'El móvil debe ser una cadena de caracteres',
            'movil.max' => 'El móvil no puede superar los 255 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser una dirección de correo válida',
            'email.string' => 'El email debe ser una cadena de caracteres',
            'email.max' => 'El email no puede superar los 255 caracteres',
            'especialidad_id.required' => 'La especialidad es obligatoria',
        ];
    }
}
