<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntoutboxStoreRequest extends FormRequest
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
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها,لايوجد'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
        ];
    }
}
