<?php

namespace App\Http\Controllers\Api;

use App\Models\MainFolder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubFolderResource;
use App\Http\Resources\SubFolderCollection;

class MainFolderSubFoldersController extends Controller
{
    public function index(
        Request $request,
        MainFolder $mainFolder
    ): SubFolderCollection {
        $this->authorize('view', $mainFolder);

        $search = $request->get('search', '');

        $subFolders = $mainFolder
            ->subFolders()
            ->search($search)
            ->latest()
            ->paginate();

        return new SubFolderCollection($subFolders);
    }

    public function store(
        Request $request,
        MainFolder $mainFolder
    ): SubFolderResource {
        $this->authorize('create', SubFolder::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $subFolder = $mainFolder->subFolders()->create($validated);

        return new SubFolderResource($subFolder);
    }
}
