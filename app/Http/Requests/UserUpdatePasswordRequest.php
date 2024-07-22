<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required', 'min:8'],
            'force_logout' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
