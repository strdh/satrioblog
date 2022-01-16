<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:100',
            'image' => ($this->getMethod() == 'POST') ? 'required|mimes:jpeg,jpg,png|max:11000' : 'nullable|mimes:jpeg,jpg,png|max:11000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Title wajib diisi",
            'title.min' => "Wajib diisi dengan min 3 karakter",
            'title.max' => "Wajib diisi dengan max 100 karakter",
        ];
    }
}

