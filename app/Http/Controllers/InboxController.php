<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\InboxStoreRequest;
use App\Http\Requests\InboxUpdateRequest;
use App\Models\Activity;
use App\Models\Intoutbox;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Inbox::class);

        $search = $request->get('search', '');

        $inboxes = Inbox::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.inboxes.index', compact('inboxes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Inbox::class);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');

        return view(
            'app.inboxes.create',
            compact('mainFolders', 'subFolders', 'mainFolders', 'subFolders')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InboxStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Inbox::class);

        $validated = $request->validated();

        $inbox = Inbox::create($validated);

        $activity = new Activity();
        $activity->user_id = Auth::id();        
        $activity->type = Activity::ADD;
        $activity->name = Inbox::NAME;
        $activity->link = Inbox::link($inbox->id);
        $activity->description = " قام " .Auth::user()->name. " ب".Activity::ADD." " .Inbox::NAME. " بتاريخ " .$inbox->created_at->format('Y-d-m');
        $activity->save();


        return redirect()
            ->route('inboxes.edit', $inbox)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Inbox $inbox): View
    {
        $this->authorize('view', $inbox);

        return view('app.inboxes.show', compact('inbox'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Inbox $inbox): View
    {
        $this->authorize('update', $inbox);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');

        return view(
            'app.inboxes.edit',
            compact(
                'inbox',
                'mainFolders',
                'subFolders',
                'mainFolders',
                'subFolders'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        InboxUpdateRequest $request,
        Inbox $inbox
    ): RedirectResponse {
        $this->authorize('update', $inbox);

        $validated = $request->validated();

        $inbox->update($validated);

        return redirect()
            ->route('inboxes.edit', $inbox)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Inbox $inbox): RedirectResponse
    {
        $this->authorize('delete', $inbox);

        $inbox->delete();

        return redirect()
            ->route('inboxes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
