<?php

namespace App\Http\Controllers\Api;

use App\Models\Intoutbox;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentCollection;

class IntoutboxAttachmentsController extends Controller
{
    public function index(
        Request $request,
        Intoutbox $intoutbox
    ): AttachmentCollection {
        $this->authorize('view', $intoutbox);

        $search = $request->get('search', '');

        $attachments = $intoutbox
            ->attachments()
            ->search($search)
            ->latest()
            ->paginate();

        return new AttachmentCollection($attachments);
    }

    public function store(
        Request $request,
        Intoutbox $intoutbox
    ): AttachmentResource {
        $this->authorize('create', Attachment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'file' => ['nullable', 'file'],
            'extoutbox_id' => ['required', 'exists:extoutboxes,id'],
            'inbox_id' => ['required', 'exists:inboxes,id'],
            'memo_id' => ['required', 'exists:memos,id'],
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment = $intoutbox->attachments()->create($validated);

        return new AttachmentResource($attachment);
    }
}
