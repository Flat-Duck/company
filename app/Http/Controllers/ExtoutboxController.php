<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use App\Models\Department;
use App\Models\Extoutbox;
use App\Models\Office;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ExtoutboxStoreRequest;
use App\Http\Requests\ExtoutboxUpdateRequest;

class ExtoutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Extoutbox::class);

        $search = $request->get('search', '');

        $extoutboxes = Extoutbox::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.extoutboxes.index', compact('extoutboxes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Extoutbox::class);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');

        $offices = Office::pluck('name');
        $administrations = Administration::pluck('name');
        $departments = Department::pluck('name');

        $fromTo = $offices->merge($departments)->merge($administrations)->values();
        return view(
            'app.extoutboxes.create',
            compact('mainFolders', 'subFolders', 'mainFolders', 'subFolders', 'fromTo'));
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExtoutboxStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Extoutbox::class);

        $validated = $request->validated();

        $extoutbox = Extoutbox::create($validated);

        return redirect()
            ->route('extoutboxes.edit', $extoutbox)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Extoutbox $extoutbox): View
    {
        $this->authorize('view', $extoutbox);

        return view('app.extoutboxes.show', compact('extoutbox'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Extoutbox $extoutbox): View
    {
        $this->authorize('update', $extoutbox);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');

        $offices = Office::pluck('name');
        $administrations = Administration::pluck('name');
        $departments = Department::pluck('name');

        $fromTo = $offices->merge($departments)->merge($administrations)->values();
        
        return view(
            'app.extoutboxes.edit',
            compact(
                'extoutbox',
                'mainFolders',
                'subFolders',
                'mainFolders',
                'subFolders',
                'fromTo'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ExtoutboxUpdateRequest $request,
        Extoutbox $extoutbox
    ): RedirectResponse {
        $this->authorize('update', $extoutbox);

        $validated = $request->validated();

        $extoutbox->update($validated);

        return redirect()
            ->route('extoutboxes.edit', $extoutbox)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Extoutbox $extoutbox
    ): RedirectResponse {
        $this->authorize('delete', $extoutbox);

        $extoutbox->delete();

        return redirect()
            ->route('extoutboxes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
