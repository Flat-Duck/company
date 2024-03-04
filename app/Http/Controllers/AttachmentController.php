<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\Inbox;
use Illuminate\View\View;
use App\Models\Extoutbox;
use App\Models\Intoutbox;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AttachmentStoreRequest;
use App\Http\Requests\AttachmentUpdateRequest;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Attachment::class);

        $search = $request->get('search', '');

        $attachments = Attachment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.attachments.index', compact('attachments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Attachment::class);

        $extoutboxes = Extoutbox::pluck('number', 'id');
        $intoutboxes = Intoutbox::pluck('number', 'id');
        $inboxes = Inbox::pluck('number', 'id');
        $memos = Memo::pluck('number', 'id');

        return view(
            'app.attachments.create',
            compact('extoutboxes', 'intoutboxes', 'inboxes', 'memos')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttachmentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Attachment::class);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment = Attachment::create($validated);

        return redirect()
            ->route('attachments.edit', $attachment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Attachment $attachment): View
    {
        $this->authorize('view', $attachment);

        return view('app.attachments.show', compact('attachment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Attachment $attachment): View
    {
        $this->authorize('update', $attachment);

        $extoutboxes = Extoutbox::pluck('number', 'id');
        $intoutboxes = Intoutbox::pluck('number', 'id');
        $inboxes = Inbox::pluck('number', 'id');
        $memos = Memo::pluck('number', 'id');

        return view(
            'app.attachments.edit',
            compact(
                'attachment',
                'extoutboxes',
                'intoutboxes',
                'inboxes',
                'memos'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AttachmentUpdateRequest $request,
        Attachment $attachment
    ): RedirectResponse {
        $this->authorize('update', $attachment);

        $validated = $request->validated();
        if ($request->hasFile('file')) {
            if ($attachment->file) {
                Storage::delete($attachment->file);
            }

            $validated['file'] = $request->file('file')->store('public');
        }

        $attachment->update($validated);

        return redirect()
            ->route('attachments.edit', $attachment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Attachment $attachment
    ): RedirectResponse {
        $this->authorize('delete', $attachment);

        if ($attachment->file) {
            Storage::delete($attachment->file);
        }

        $attachment->delete();

        return redirect()
            ->route('attachments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
