<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class Password extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'password.required'  => trans('admin_users.validation.password.required'),
            'password.confirmed' => trans('admin_users.validation.password.confirmed')
        ];
    }
}

