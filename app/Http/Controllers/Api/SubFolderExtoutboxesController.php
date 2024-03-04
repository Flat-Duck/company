<?php

namespace App\Http\Controllers\Api;

use App\Models\SubFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExtoutboxResource;
use App\Http\Resources\ExtoutboxCollection;

class SubFolderExtoutboxesController extends Controller
{
    public function index(
        Request $request,
        SubFolder $subFolder
    ): ExtoutboxCollection {
        $this->authorize('view', $subFolder);

        $search = $request->get('search', '');

        $extoutboxes = $subFolder
            ->extoutboxes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExtoutboxCollection($extoutboxes);
    }

    public function store(
        Request $request,
        SubFolder $subFolder
    ): ExtoutboxResource {
        $this->authorize('create', Extoutbox::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
        ]);

        $extoutbox = $subFolder->extoutboxes()->create($validated);

        return new ExtoutboxResource($extoutbox);
    }
}
