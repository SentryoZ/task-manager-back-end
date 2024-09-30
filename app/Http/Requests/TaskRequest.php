<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'assigned_user_id' => ['required', 'exists:users,id'],
            'start_time' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'project_id' => ['required', 'exists:projects,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
