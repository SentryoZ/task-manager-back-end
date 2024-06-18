<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $uniqueRule = Rule::unique('users');
        if (!is_null($this->route()->user)) {
            $uniqueRule->ignore($this->route()->user->id);
        }

        return [
            'name' => ['required'],
            'email' => ['required', 'email', $uniqueRule],
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
