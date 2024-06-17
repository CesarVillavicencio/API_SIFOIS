<?php

namespace App\Http\Requests\Admin;

use AdminHelpers;
use Illuminate\Foundation\Http\FormRequest;

class Image extends FormRequest {
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
        $kilobytes = env('MAX_FILE_SIZE', 2097152) / 1024;

        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:'.$kilobytes,
        ];
    }

    public function messages() {
        return [
            'imagen.required' => trans('image.validation.image.required'),
            'imagen.image' => trans('image.validation.image.image'),
            'imagen.max' => trans('image.validation.image.max', ['size' => AdminHelpers::formatBytes(env('MAX_FILE_SIZE', 2097152))]),
        ];
    }
}
