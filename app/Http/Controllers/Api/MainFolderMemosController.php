<?php

namespace App\Http\Controllers\Api;

use App\Models\MainFolder;
use Illuminate\Http\Request;
use App\Http\Resources\MemoResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemoCollection;

class MainFolderMemosController extends Controller
{
    public function index(
        Request $request,
        MainFolder $mainFolder
    ): MemoCollection {
        $this->authorize('view', $mainFolder);

        $search = $request->get('search', '');

        $memos = $mainFolder
            ->memos()
            ->search($search)
            ->latest()
            ->paginate();

        return new MemoCollection($memos);
    }

    public function store(
        Request $request,
        MainFolder $mainFolder
    ): MemoResource {
        $this->authorize('create', Memo::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'type' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
            'sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
        ]);

        $memo = $mainFolder->memos()->create($validated);

        return new MemoResource($memo);
    }
}
