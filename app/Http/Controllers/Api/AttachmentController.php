<?php

namespace App\Http\Controllers\Api;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AttachmentResource;
use App\Http\Resources\AttachmentCollection;
use App\Http\Requests\AttachmentStoreRequest;
use App\Http\Requests\AttachmentUpdateRequest;

class AttachmentController extends Controller
{
    public function index(Request $request): AttachmentCollection
    {
        $this->authorize('view-any', Attachment::class);

        $search = $request->get('search', '');

        $attachments = Attachment::search($search)
            ->latest()
            ->paginate();

        return new AttachmentCollection($attachments);
    }

    public function store(AttachmentStoreRequest $request): AttachmentResource
    {
        $this->authorize('create', Attachment::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment = Attachment::create($validated);

        return new AttachmentResource($attachment);
    }

    public function show(
        Request $request,
        Attachment $attachment
    ): AttachmentResource {
        $this->authorize('view', $attachment);

        return new AttachmentResource($attachment);
    }

    public function update(
        AttachmentUpdateRequest $request,
        Attachment $attachment
    ): AttachmentResource {
        $this->authorize('update', $attachment);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($attachment->file) {
                Storage::delete($attachment->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment->update($validated);

        return new AttachmentResource($attachment);
    }

    public function destroy(Request $request, Attachment $attachment): Response
    {
        $this->authorize('delete', $attachment);

        if ($attachment->file) {
            Storage::delete($attachment->file);
        }

        $attachment->delete();

        return response()->noContent();
    }
}
