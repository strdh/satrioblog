<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:50',
            'short_description' => 'required|min:20|max:250',
            'content' => 'required|min:50',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:5100',
        ];
    }

    public function messages()
    {
        return [
            'name.requierd' => "Name Wajib diisi dengan minimal 3 karakter dan max 100 karakter",
            'name.min' => "Name minimal 3 karakter",
            'name.max' => "Name maksimal 100 karakter",
            'content.required' => "Content wajib diisi",
            'short_description.required' => 'Short description wajib diisi dengan min 20 karakter dan max 100 karakter',
            'image.mimes' => "Format yang diperbolehkan adalah jpeg, jpg, dan png",
            "image.max" => "Ukuran file maksimal 5 Mb",
        ];
    }
}
