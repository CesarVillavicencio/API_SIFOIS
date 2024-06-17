<?php

namespace App\Http\Requests\Admin\Blog;

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
            'date' => 'required',
            'id_category' => 'required',
            'description' => 'required',
            'content' => 'required',
            'author' => 'required',
            'image' => 'required',
            'publish' => 'required',
        ];
    }

    public function messages() {
        return [
            'title.required' => trans('blog.validation.title.required'),
            'date.required' => trans('blog.validation.date.required'),
            'id_category.required' => trans('blog.validation.id_category.required'),
            'description.required' => trans('blog.validation.description.required'),
            'content.required' => trans('blog.validation.content.required'),
            'author.required' => trans('blog.validation.author.required'),
            'image.required' => trans('blog.validation.image.required'),
        ];
    }
}
