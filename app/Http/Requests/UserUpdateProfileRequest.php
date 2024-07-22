<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
            'avatar' => ['file', 'mimes:jpg,png', 'nullable']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
