<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CondidateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:candidates,name',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'election_number' => 'required|integer|unique:candidates',
        ];
    }
}
