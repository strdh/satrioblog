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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Name Wajib diisi dengan minimal 3 karakter dan max 100 karakter",
            'name.min' => "Name minimal 3 karakter",
            'name.max' => "Name maksimal 100 karakter",
        ];
    }
}
