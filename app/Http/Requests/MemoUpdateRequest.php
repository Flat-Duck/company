<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'type' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
        ];
    }
}
