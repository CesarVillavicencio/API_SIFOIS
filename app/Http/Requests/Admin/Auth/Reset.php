<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Reset extends FormRequest {
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
            'email' => 'required|email',
            'password' => 'required|min:6|max:191|confirmed',
            'token' => 'required',
        ];
    }

    public function messages() {
        return [
            'email.required' => trans('auth.validation.email.required'),
            'email.email' => trans('auth.validation.email.email'),
            'password.required' => trans('auth.validation.password.required'),
            'password.min' => trans('auth.validation.password.min'),
            'password.max' => trans('auth.validation.password.max'),
            'password.confirmed' => trans('auth.validation.password.confirmed'),
        ];
    }
}
