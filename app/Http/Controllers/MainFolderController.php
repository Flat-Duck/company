<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MainFolderStoreRequest;
use App\Http\Requests\MainFolderUpdateRequest;

class MainFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', MainFolder::class);

        $search = $request->get('search', '');

        $mainFolders = MainFolder::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.main_folders.index', compact('mainFolders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', MainFolder::class);

        return view('app.main_folders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainFolderStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', MainFolder::class);

        $validated = $request->validated();

        $mainFolder = MainFolder::create($validated);

        return redirect()
            ->route('main-folders.edit', $mainFolder)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, MainFolder $mainFolder): View
    {
        $this->authorize('view', $mainFolder);

        return view('app.main_folders.show', compact('mainFolder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, MainFolder $mainFolder): View
    {
        $this->authorize('update', $mainFolder);

        return view('app.main_folders.edit', compact('mainFolder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MainFolderUpdateRequest $request,
        MainFolder $mainFolder
    ): RedirectResponse {
        $this->authorize('update', $mainFolder);

        $validated = $request->validated();

        $mainFolder->update($validated);

        return redirect()
            ->route('main-folders.edit', $mainFolder)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        MainFolder $mainFolder
    ): RedirectResponse {
        $this->authorize('delete', $mainFolder);

        $mainFolder->delete();

        return redirect()
            ->route('main-folders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
