<?php

namespace App\Http\Requests\Admin\Gallery;

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
            'id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'id_category' => 'required',
        ];
    }

    public function messages() {
        return [
            'id.required' => trans('gallery.validation.id.required'),
            'title.required' => trans('gallery.validation.title.required'),
            'id_category.required' => trans('gallery.validation.id_category.required'),
            'description.required' => trans('gallery.validation.description.required'),
            'image.required' => trans('gallery.validation.image.required'),
        ];
    }
}
