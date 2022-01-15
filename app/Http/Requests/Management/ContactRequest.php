<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Name wajib diisi",
            'value' => "Value wajib diisi"
        ];
    }

}
