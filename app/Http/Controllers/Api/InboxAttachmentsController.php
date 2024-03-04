<?php

namespace App\Http\Controllers\Api;

use App\Models\Inbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentCollection;

class InboxAttachmentsController extends Controller
{
    public function index(Request $request, Inbox $inbox): AttachmentCollection
    {
        $this->authorize('view', $inbox);

        $search = $request->get('search', '');

        $attachments = $inbox
            ->attachments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AttachmentCollection($attachments);
    }

    public function store(Request $request, Inbox $inbox): AttachmentResource
    {
        $this->authorize('create', Attachment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'extoutbox_id' => ['required', 'exists:extoutboxes,id'],
            'intoutbox_id' => ['required', 'exists:intoutboxes,id'],
            'memo_id' => ['required', 'exists:memos,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment = $inbox->attachments()->create($validated);

        return new AttachmentResource($attachment);
    }
}
