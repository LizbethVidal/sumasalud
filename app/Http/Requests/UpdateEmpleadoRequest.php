<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
            'dni' => 'required|string|max:9',
            'movil' => 'required|string|max:9',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
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
            'name.string' => 'El nombre debe ser un texto',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'dni.required' => 'El DNI es obligatorio',
            'dni.string' => 'El DNI debe ser un texto',
            'dni.max' => 'El DNI no puede superar los 9 caracteres',
            'movil.required' => 'El móvil es obligatorio',
            'movil.string' => 'El móvil debe ser un texto',
            'movil.max' => 'El móvil no puede superar los 9 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.string' => 'El email debe ser un texto',
            'email.email' => 'El email debe ser un email válido',
            'email.max' => 'El email no puede superar los 255 caracteres',
            'password.string' => 'La contraseña debe ser un texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}
