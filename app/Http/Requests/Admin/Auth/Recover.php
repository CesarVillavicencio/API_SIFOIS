<?php

namespace App\Http\Requests\Admin\Auth;

use App\Rules\ValidHCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class Recover extends FormRequest {
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
            'email' => 'required|email|max:255',
            'captcha' => ['required', new ValidHCaptcha()],
        ];
    }

    public function messages() {
        return [
            'email.required' => trans('auth.validation.email.required'),
            'email.email' => trans('auth.validation.email.email'),
            'email.max' => trans('auth.validation.email.max'),
            'captcha.required' => trans('auth.validation.captcha.invalid'),
        ];
    }
}
