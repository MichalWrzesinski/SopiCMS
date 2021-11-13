<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:10', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'integer'],
            'region' => ['required', 'integer'],
            'city' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:100'],
        ];
    }
}
