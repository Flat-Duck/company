<?php

namespace App\Http\Controllers;

use App\Models\Administration;
use App\Models\Department;
use App\Models\Intoutbox;
use App\Models\Office;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IntoutboxStoreRequest;
use App\Http\Requests\IntoutboxUpdateRequest;

class IntoutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Intoutbox::class);

        $search = $request->get('search', '');

        $intoutboxes = Intoutbox::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.intoutboxes.index', compact('intoutboxes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Intoutbox::class);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');
        $offices = Office::pluck('name');
        $administrations = Administration::pluck('name');
        $departments = Department::pluck('name');

        $fromTo = $offices->merge($departments)->merge($administrations)->values();

        return view(
            'app.intoutboxes.create',
            compact('mainFolders', 'subFolders', 'mainFolders', 'subFolders', 'fromTo')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IntoutboxStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Intoutbox::class);

        $validated = $request->validated();

        $intoutbox = Intoutbox::create($validated);

        return redirect()
            ->route('intoutboxes.edit', $intoutbox)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Intoutbox $intoutbox): View
    {
        $this->authorize('view', $intoutbox);

        return view('app.intoutboxes.show', compact('intoutbox'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Intoutbox $intoutbox): View
    {
        $this->authorize('update', $intoutbox);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');
        $offices = Office::pluck('name');
        $administrations = Administration::pluck('name');
        $departments = Department::pluck('name');

        $fromTo = $offices->merge($departments)->merge($administrations)->values();

        return view(
            'app.intoutboxes.edit',
            compact(
                'intoutbox',
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
        IntoutboxUpdateRequest $request,
        Intoutbox $intoutbox
    ): RedirectResponse {
        $this->authorize('update', $intoutbox);

        $validated = $request->validated();

        $intoutbox->update($validated);

        return redirect()
            ->route('intoutboxes.edit', $intoutbox)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Intoutbox $intoutbox
    ): RedirectResponse {
        $this->authorize('delete', $intoutbox);

        $intoutbox->delete();

        return redirect()
            ->route('intoutboxes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
