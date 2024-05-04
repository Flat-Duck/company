<?php

namespace App\Http\Controllers\Api;

use App\Models\SubFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntoutboxResource;
use App\Http\Resources\IntoutboxCollection;

class SubFolderIntoutboxesController extends Controller
{
    public function index(
        Request $request,
        SubFolder $subFolder
    ): IntoutboxCollection {
        $this->authorize('view', $subFolder);

        $search = $request->get('search', '');

        $intoutboxes = $subFolder
            ->intoutboxes()
            ->search($search)
            ->latest()
            ->paginate();

        return new IntoutboxCollection($intoutboxes);
    }

    public function store(
        Request $request,
        SubFolder $subFolder
    ): IntoutboxResource {
        $this->authorize('create', Intoutbox::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها,لا يوجد'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
        ]);

        $intoutbox = $subFolder->intoutboxes()->create($validated);

        return new IntoutboxResource($intoutbox);
    }
}
