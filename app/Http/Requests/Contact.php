<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Contact extends FormRequest {
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'comment' => 'required|string',
            'captcha' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => trans('contact.validation.name.required'),
            'name.max' => trans('contact.validation.name.max'),
            'email.required' => trans('contact.validation.email.required'),
            'email.email' => trans('contact.validation.email.email'),
            'email.max' => trans('contact.validation.email.max'),
            'subject.required' => trans('contact.validation.subject.required'),
            'subject.max' => trans('contact.validation.subject.max'),
            'comment.required' => trans('contact.validation.comment.required'),
            'captcha.required' => trans('contact.validation.captcha.required'),
        ];
    }
}
