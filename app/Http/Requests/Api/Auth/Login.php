<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'username' => 'required|max:255',
            'password' => 'required',
        ];
    }

    public function messages() {
        return [
            'username.required' => 'El nombre de usuario es requerido',
            'username.max'      => 'El numero de caracteres en el correo es incorrecto',
            'password.required' => 'La contraseña es requerida',
        ];
    }
}