<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if(Auth::id() > 0) {
            return [
                'name' => ['required', 'min:3', 'max:30'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:8', 'confirmed'],
            ];
        }

        return [
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'regulations' => ['required']
        ];
    }
}
