<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name.required' => 'Please provide a project name.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}