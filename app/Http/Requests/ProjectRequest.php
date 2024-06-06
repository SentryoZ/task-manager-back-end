<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['nullable'],
            'short_description' => ['nullable'],
            'status' => ['required', 'integer', Rule::in(array_keys(Project::STATUSES))],
            'visibility' => ['required', 'integer', Rule::in(array_keys(Project::VISIBILITIES))],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
