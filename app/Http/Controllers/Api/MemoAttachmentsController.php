<?php

namespace App\Http\Controllers\Api;

use App\Models\Memo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentCollection;

class MemoAttachmentsController extends Controller
{
    public function index(Request $request, Memo $memo): AttachmentCollection
    {
        $this->authorize('view', $memo);

        $search = $request->get('search', '');

        $attachments = $memo
            ->attachments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AttachmentCollection($attachments);
    }

    public function store(Request $request, Memo $memo): AttachmentResource
    {
        $this->authorize('create', Attachment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'extoutbox_id' => ['required', 'exists:extoutboxes,id'],
            'intoutbox_id' => ['required', 'exists:intoutboxes,id'],
            'inbox_id' => ['required', 'exists:inboxes,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment = $memo->attachments()->create($validated);

        return new AttachmentResource($attachment);
    }
}
