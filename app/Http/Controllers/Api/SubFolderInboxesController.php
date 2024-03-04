<?php

namespace App\Http\Controllers\Api;

use App\Models\SubFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InboxResource;
use App\Http\Resources\InboxCollection;

class SubFolderInboxesController extends Controller
{
    public function index(
        Request $request,
        SubFolder $subFolder
    ): InboxCollection {
        $this->authorize('view', $subFolder);

        $search = $request->get('search', '');

        $inboxes = $subFolder
            ->inboxes()
            ->search($search)
            ->latest()
            ->paginate();

        return new InboxCollection($inboxes);
    }

    public function store(Request $request, SubFolder $subFolder): InboxResource
    {
        $this->authorize('create', Inbox::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'type' => ['required', 'in:شخصي,طلب'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
        ]);

        $inbox = $subFolder->inboxes()->create($validated);

        return new InboxResource($inbox);
    }
}
