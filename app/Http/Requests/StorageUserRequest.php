<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorageUserRequest extends FormRequest
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
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'email|required|string|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|string|max:255',
            'dni' => 'required|string|max:255|unique:users,dni',
            'movil' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'fecha_nac' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser una dirección de correo válida',
            'email.string' => 'El email debe ser una cadena de caracteres',
            'email.max' => 'El email no puede superar los 255 caracteres',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'La contraseña debe ser una cadena de caracteres',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'rol.required' => 'El rol es obligatorio',
            'rol.string' => 'El rol debe ser una cadena de caracteres',
            'rol.max' => 'El rol no puede superar los 255 caracteres',
            'dni.required' => 'El DNI es obligatorio',
            'dni.string' => 'El DNI debe ser una cadena de caracteres',
            'dni.max' => 'El DNI no puede superar los 255 caracteres',
            'dni.unique' => 'El DNI ya está en uso',
            'movil.required' => 'El teléfono es obligatorio',
            'movil.string' => 'El teléfono debe ser una cadena de caracteres',
            'movil.max' => 'El teléfono no puede superar los 255 caracteres',
            'direccion.string' => 'La dirección debe ser una cadena de caracteres',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres',
            'fecha_nac.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nac.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'foto.image' => 'La foto debe ser una imagen',
            'foto.mimes' => 'La foto debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'foto.max' => 'La foto no puede superar los 2048 kilobytes',
        ];
    }

    public static function msg(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de caracteres',
            'name.max' => 'El nombre no puede superar los 255 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser una dirección de correo válida',
            'email.string' => 'El email debe ser una cadena de caracteres',
            'email.max' => 'El email no puede superar los 255 caracteres',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'La contraseña debe ser una cadena de caracteres',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'rol.required' => 'El rol es obligatorio',
            'rol.string' => 'El rol debe ser una cadena de caracteres',
            'rol.max' => 'El rol no puede superar los 255 caracteres',
            'tutor_id.exists' => 'El tutor no existe',
            'dni.required' => 'El DNI es obligatorio',
            'dni.string' => 'El DNI debe ser una cadena de caracteres',
            'dni.max' => 'El DNI no puede superar los 255 caracteres',
            'dni.unique' => 'El DNI ya está en uso',
            'movil.required' => 'El teléfono es obligatorio',
            'movil.string' => 'El teléfono debe ser una cadena de caracteres',
            'movil.max' => 'El teléfono no puede superar los 255 caracteres',
            'direccion.required' => 'La dirección es obligatoria',
            'direccion.string' => 'La dirección debe ser una cadena de caracteres',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres',
            'fecha_nac.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_nac.date' => 'La fecha de nacimiento debe ser una fecha válida',
            'foto.image' => 'La foto debe ser una imagen',
            'foto.mimes' => 'La foto debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'foto.max' => 'La foto no puede superar los 2048 kilobytes',
        ];
    }
}
