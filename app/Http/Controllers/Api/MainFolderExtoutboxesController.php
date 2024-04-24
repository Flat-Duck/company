<?php

namespace App\Http\Controllers\Api;

use App\Models\MainFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExtoutboxResource;
use App\Http\Resources\ExtoutboxCollection;

class MainFolderExtoutboxesController extends Controller
{
    public function index(
        Request $request,
        MainFolder $mainFolder
    ): ExtoutboxCollection {
        $this->authorize('view', $mainFolder);

        $search = $request->get('search', '');

        $extoutboxes = $mainFolder
            ->extoutboxes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExtoutboxCollection($extoutboxes);
    }

    public function store(
        Request $request,
        MainFolder $mainFolder
    ): ExtoutboxResource {
        $this->authorize('create', Extoutbox::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها,لايوجد'],
            'sub_folder_id' => ['required', 'exists:sub_folders,id'],
            'sub_folder_id' => ['required', 'exists:sub_folders,id'],
        ]);

        $extoutbox = $mainFolder->extoutboxes()->create($validated);

        return new ExtoutboxResource($extoutbox);
    }
}
