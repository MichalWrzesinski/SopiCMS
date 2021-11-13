<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'file', 'image', 'mimes:jpg,jpeg,gif,png,bmp', 'max:10240'],
        ];
    }
}
