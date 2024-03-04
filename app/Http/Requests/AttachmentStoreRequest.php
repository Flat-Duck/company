<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'extoutbox_id' => ['required', 'exists:extoutboxes,id'],
            'intoutbox_id' => ['required', 'exists:intoutboxes,id'],
            'inbox_id' => ['required', 'exists:inboxes,id'],
            'memo_id' => ['required', 'exists:memos,id'],
        ];
    }
}
