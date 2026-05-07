<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The project name cannot be empty.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}