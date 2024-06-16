<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'policies' => ['required', 'json']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
