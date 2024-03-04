<?php

namespace App\Http\Controllers\Api;

use App\Models\SubFolder;
use Illuminate\Http\Request;
use App\Http\Resources\MemoResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemoCollection;

class SubFolderMemosController extends Controller
{
    public function index(
        Request $request,
        SubFolder $subFolder
    ): MemoCollection {
        $this->authorize('view', $subFolder);

        $search = $request->get('search', '');

        $memos = $subFolder
            ->memos()
            ->search($search)
            ->latest()
            ->paginate();

        return new MemoCollection($memos);
    }

    public function store(Request $request, SubFolder $subFolder): MemoResource
    {
        $this->authorize('create', Memo::class);

        $validated = $request->validate([
            'number' => ['required', 'max:255', 'string'],
            'registered_at' => ['required', 'date'],
            'issued_at' => ['required', 'date'],
            'type' => ['required', 'max:255', 'string'],
            'subject' => ['required', 'max:255', 'string'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
            'main_folder_id' => ['required', 'exists:main_folders,id'],
        ]);

        $memo = $subFolder->memos()->create($validated);

        return new MemoResource($memo);
    }
}
