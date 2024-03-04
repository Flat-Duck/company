<?php

namespace App\Http\Controllers\Api;

use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MainFolderResource;
use App\Http\Resources\MainFolderCollection;
use App\Http\Requests\MainFolderStoreRequest;
use App\Http\Requests\MainFolderUpdateRequest;

class MainFolderController extends Controller
{
    public function index(Request $request): MainFolderCollection
    {
        $this->authorize('view-any', MainFolder::class);

        $search = $request->get('search', '');

        $mainFolders = MainFolder::search($search)
            ->latest()
            ->paginate();

        return new MainFolderCollection($mainFolders);
    }

    public function store(MainFolderStoreRequest $request): MainFolderResource
    {
        $this->authorize('create', MainFolder::class);

        $validated = $request->validated();

        $mainFolder = MainFolder::create($validated);

        return new MainFolderResource($mainFolder);
    }

    public function show(
        Request $request,
        MainFolder $mainFolder
    ): MainFolderResource {
        $this->authorize('view', $mainFolder);

        return new MainFolderResource($mainFolder);
    }

    public function update(
        MainFolderUpdateRequest $request,
        MainFolder $mainFolder
    ): MainFolderResource {
        $this->authorize('update', $mainFolder);

        $validated = $request->validated();

        $mainFolder->update($validated);

        return new MainFolderResource($mainFolder);
    }

    public function destroy(Request $request, MainFolder $mainFolder): Response
    {
        $this->authorize('delete', $mainFolder);

        $mainFolder->delete();

        return response()->noContent();
    }
}
