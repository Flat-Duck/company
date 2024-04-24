<?php

namespace App\Http\Controllers\Api;

use App\Models\MainFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InboxResource;
use App\Http\Resources\InboxCollection;

class MainFolderInboxesController extends Controller
{
    public function index(
        Request $request,
        MainFolder $mainFolder
    ): InboxCollection {
        $this->authorize('view', $mainFolder);

        $search = $request->get('search', '');

        $inboxes = $mainFolder
            ->inboxes()
            ->search($search)
            ->latest()
            ->paginate();

        return new InboxCollection($inboxes);
    }

    public function store(
        Request $request,
        MainFolder $mainFolder
    ): InboxResource {
        $this->authorize('create', Inbox::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'type' => ['required', 'in:شخصي,طلب'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها,لايوجد'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
        ]);

        $inbox = $mainFolder->inboxes()->create($validated);

        return new InboxResource($inbox);
    }
}
