<?php

namespace App\Http\Controllers\Api;

use App\Models\Memo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\MemoResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemoCollection;
use App\Http\Requests\MemoStoreRequest;
use App\Http\Requests\MemoUpdateRequest;

class MemoController extends Controller
{
    public function index(Request $request): MemoCollection
    {
        $this->authorize('view-any', Memo::class);

        $search = $request->get('search', '');

        $memos = Memo::search($search)
            ->latest()
            ->paginate();

        return new MemoCollection($memos);
    }

    public function store(MemoStoreRequest $request): MemoResource
    {
        $this->authorize('create', Memo::class);

        $validated = $request->validated();

        $memo = Memo::create($validated);

        return new MemoResource($memo);
    }

    public function show(Request $request, Memo $memo): MemoResource
    {
        $this->authorize('view', $memo);

        return new MemoResource($memo);
    }

    public function update(MemoUpdateRequest $request, Memo $memo): MemoResource
    {
        $this->authorize('update', $memo);

        $validated = $request->validated();

        $memo->update($validated);

        return new MemoResource($memo);
    }

    public function destroy(Request $request, Memo $memo): Response
    {
        $this->authorize('delete', $memo);

        $memo->delete();

        return response()->noContent();
    }
}
