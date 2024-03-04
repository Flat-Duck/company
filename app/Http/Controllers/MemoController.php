<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MemoStoreRequest;
use App\Http\Requests\MemoUpdateRequest;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Memo::class);

        $search = $request->get('search', '');

        $memos = Memo::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.memos.index', compact('memos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Memo::class);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');

        return view(
            'app.memos.create',
            compact('mainFolders', 'subFolders', 'mainFolders', 'subFolders')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemoStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Memo::class);

        $validated = $request->validated();

        $memo = Memo::create($validated);

        return redirect()
            ->route('memos.edit', $memo)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Memo $memo): View
    {
        $this->authorize('view', $memo);

        return view('app.memos.show', compact('memo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Memo $memo): View
    {
        $this->authorize('update', $memo);

        $mainFolders = MainFolder::pluck('name', 'id');
        $subFolders = SubFolder::pluck('name', 'id');

        return view(
            'app.memos.edit',
            compact(
                'memo',
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
        MemoUpdateRequest $request,
        Memo $memo
    ): RedirectResponse {
        $this->authorize('update', $memo);

        $validated = $request->validated();

        $memo->update($validated);

        return redirect()
            ->route('memos.edit', $memo)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Memo $memo): RedirectResponse
    {
        $this->authorize('delete', $memo);

        $memo->delete();

        return redirect()
            ->route('memos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
