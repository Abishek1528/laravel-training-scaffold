<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:todo,in_progress,completed',
            'due_date' => 'nullable|date',
            'assigned_to_id' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'A task title is required.',
            'status.in' => 'The selected status is invalid.',
            'due_date.date' => 'The due date must be a valid date.',
            'assigned_to_id.exists' => 'The selected user does not exist.',
        ];
    }
}