<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Name Wajib diisi dengan minimal 3 karakter dan max 100 karakter",
            'name.min' => "Name minimal 3 karakter",
            'name.max' => "Name maksimal 100 karakter",
            'image.mimes' => "Format yang diperbolehkan adalah jpeg, jpg, dan png",
            "image.max" => "Ukuran file maksimal 5 Mb",
        ];
    }
}
