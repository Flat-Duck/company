<?php

namespace App\Http\Controllers\Api;

use App\Models\MainFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntoutboxResource;
use App\Http\Resources\IntoutboxCollection;

class MainFolderIntoutboxesController extends Controller
{
    public function index(
        Request $request,
        MainFolder $mainFolder
    ): IntoutboxCollection {
        $this->authorize('view', $mainFolder);

        $search = $request->get('search', '');

        $intoutboxes = $mainFolder
            ->intoutboxes()
            ->search($search)
            ->latest()
            ->paginate();

        return new IntoutboxCollection($intoutboxes);
    }

    public function store(
        Request $request,
        MainFolder $mainFolder
    ): IntoutboxResource {
        $this->authorize('create', Intoutbox::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'sender' => ['required', 'max:255', 'string'],
            'receiver' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها,لايوجد'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
        ]);

        $intoutbox = $mainFolder->intoutboxes()->create($validated);

        return new IntoutboxResource($intoutbox);
    }
}
