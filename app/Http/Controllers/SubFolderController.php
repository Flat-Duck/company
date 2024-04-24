<?php

namespace App\Http\Controllers;

use App\Models\SubFolder;
use Illuminate\View\View;
use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SubFolderStoreRequest;
use App\Http\Requests\SubFolderUpdateRequest;

class SubFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SubFolder::class);

        $search = $request->get('search', '');

        $subFolders = SubFolder::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.sub_folders.index', compact('subFolders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SubFolder::class);

        $mainFolders = MainFolder::pluck('name', 'id');

        return view('app.sub_folders.create', compact('mainFolders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubFolderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SubFolder::class);

        $validated = $request->validated();

        $subFolder = SubFolder::create($validated);

        return redirect()
            ->route('sub-folders.edit', $subFolder)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SubFolder $subFolder): View
    {
        $this->authorize('view', $subFolder);
        $intouts = $subFolder->intoutboxes()->paginate(5);
        $extouts = $subFolder->extoutboxes()->paginate(5);
        $inboxes = $subFolder->inboxes()->paginate(5);
        $memos = $subFolder->memos()->paginate(5);

        return view('app.sub_folders.show', compact('subFolder', 'intouts', 'extouts','inboxes', 'memos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SubFolder $subFolder): View
    {
        $this->authorize('update', $subFolder);

        $mainFolders = MainFolder::pluck('name', 'id');

        return view(
            'app.sub_folders.edit',
            compact('subFolder', 'mainFolders')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SubFolderUpdateRequest $request,
        SubFolder $subFolder
    ): RedirectResponse {
        $this->authorize('update', $subFolder);

        $validated = $request->validated();

        $subFolder->update($validated);

        return redirect()
            ->route('sub-folders.edit', $subFolder)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SubFolder $subFolder
    ): RedirectResponse {
        $this->authorize('delete', $subFolder);

        $subFolder->delete();

        return redirect()
            ->route('sub-folders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
