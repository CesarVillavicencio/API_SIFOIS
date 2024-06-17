<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest {
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
            'id'       => 'required',
            'name'     => 'required',
            'lastname' => 'required',
            'email'    => 'email|required',
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
            'type.required'      => trans('admin_users.validation.type.required'),
            // 'avatar.required'    => trans('admin_users.validation.avatar.required')
        ];
    }
}
