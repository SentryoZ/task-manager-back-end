<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'short_description' => ['nullable'],
            'status' => ['required', 'integer'],
            'visibility' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
