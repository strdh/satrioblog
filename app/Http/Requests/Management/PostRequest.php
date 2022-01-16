<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:100',
            'category_id' => 'required',
            'thumbnail' => ($this->getMethod() == 'POST') ? 'required|mimes:jpeg,jpg,png|max:5100' : 'nullable|mimes:jpeg,jpg,png|max:5100',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title wajib diisi dengan min 3 karakter dan max 100 karakter',
            'title.min' => "Title wajib diisi dengan min 3 karakter",
            'title.max' => "Titile tidak boleh melebihi 100 karakter",
            'category_id.required' => 'Category wajib diisi',
            'thumbnail.required' => 'Thumbnail wajib diisi',
            'content.required' => 'Content Wajib diisi'
        ];
    }
}
