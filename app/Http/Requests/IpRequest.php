<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IpRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ip' => ['required', 'ip', 'unique:bans,ip']
        ];
    }
}
