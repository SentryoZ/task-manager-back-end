<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'status' => ['required', 'boolean'],
            'role_id' => ['required', 'int'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
