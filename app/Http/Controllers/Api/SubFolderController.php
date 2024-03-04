<?php

namespace App\Http\Controllers\Api;

use App\Models\SubFolder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubFolderResource;
use App\Http\Resources\SubFolderCollection;
use App\Http\Requests\SubFolderStoreRequest;
use App\Http\Requests\SubFolderUpdateRequest;

class SubFolderController extends Controller
{
    public function index(Request $request): SubFolderCollection
    {
        $this->authorize('view-any', SubFolder::class);

        $search = $request->get('search', '');

        $subFolders = SubFolder::search($search)
            ->latest()
            ->paginate();

        return new SubFolderCollection($subFolders);
    }

    public function store(SubFolderStoreRequest $request): SubFolderResource
    {
        $this->authorize('create', SubFolder::class);

        $validated = $request->validated();

        $subFolder = SubFolder::create($validated);

        return new SubFolderResource($subFolder);
    }

    public function show(
        Request $request,
        SubFolder $subFolder
    ): SubFolderResource {
        $this->authorize('view', $subFolder);

        return new SubFolderResource($subFolder);
    }

    public function update(
        SubFolderUpdateRequest $request,
        SubFolder $subFolder
    ): SubFolderResource {
        $this->authorize('update', $subFolder);

        $validated = $request->validated();

        $subFolder->update($validated);

        return new SubFolderResource($subFolder);
    }

    public function destroy(Request $request, SubFolder $subFolder): Response
    {
        $this->authorize('delete', $subFolder);

        $subFolder->delete();

        return response()->noContent();
    }
}
