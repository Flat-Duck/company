<?php

namespace App\Http\Controllers\Api;

use App\Models\Extoutbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentCollection;

class ExtoutboxAttachmentsController extends Controller
{
    public function index(
        Request $request,
        Extoutbox $extoutbox
    ): AttachmentCollection {
        $this->authorize('view', $extoutbox);

        $search = $request->get('search', '');

        $attachments = $extoutbox
            ->attachments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AttachmentCollection($attachments);
    }

    public function store(
        Request $request,
        Extoutbox $extoutbox
    ): AttachmentResource {
        $this->authorize('create', Attachment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'intoutbox_id' => ['required', 'exists:intoutboxes,id'],
            'inbox_id' => ['required', 'exists:inboxes,id'],
            'memo_id' => ['required', 'exists:memos,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment = $extoutbox->attachments()->create($validated);

        return new AttachmentResource($attachment);
    }
}
