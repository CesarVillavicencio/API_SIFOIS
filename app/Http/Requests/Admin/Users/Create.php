<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest {
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
            'name'     => 'required',
            'lastname' => 'required',
            'email'    => 'email|required|unique:admin_users',
            'password' => 'required|confirmed',
            // 'avatar'   => 'required',
            'type'     => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required'      => trans('admin_users.validation.name.required'),
            'lastname.required'  => trans('admin_users.validation.lastname.required'),
            'email.required'     => trans('admin_users.validation.email.required'),
            'email.email'        => trans('admin_users.validation.email.email'),
            'email.unique'       => trans('admin_users.validation.email.unique'),
            'password.required'  => trans('admin_users.validation.password.required'),
            'password.confirmed' => trans('admin_users.validation.password.confirmed'),
            'type.required'      => trans('admin_users.validation.type.required'),
            // 'avatar.required'    => trans('admin_users.validation.avatar.required')
        ];
    }
}
