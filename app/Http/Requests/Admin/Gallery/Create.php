<?php

namespace App\Http\Requests\Admin\Gallery;

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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'id_category' => 'required',
        ];
    }

    public function messages() {
        return [
            'title.required' => trans('gallery.validation.title.required'),
            'description.required' => trans('gallery.validation.description.required'),
            'image.required' => trans('gallery.validation.image.required'),
            'id_category.required' => trans('gallery.validation.id_category.required'),
        ];
    }
}
