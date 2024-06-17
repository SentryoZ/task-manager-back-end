<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route()->user->id)],
            'status' => ['required', 'boolean'],
            'role_id' => ['required', 'int'],
            'avatar' => ['file', 'mimes:jpg,png', 'nullable']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
