<?php

namespace App\Http\Controllers\Api;

use App\Models\Extoutbox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExtoutboxResource;
use App\Http\Resources\ExtoutboxCollection;
use App\Http\Requests\ExtoutboxStoreRequest;
use App\Http\Requests\ExtoutboxUpdateRequest;

class ExtoutboxController extends Controller
{
    public function index(Request $request): ExtoutboxCollection
    {
        $this->authorize('view-any', Extoutbox::class);

        $search = $request->get('search', '');

        $extoutboxes = Extoutbox::search($search)
            ->latest()
            ->paginate();

        return new ExtoutboxCollection($extoutboxes);
    }

    public function store(ExtoutboxStoreRequest $request): ExtoutboxResource
    {
        $this->authorize('create', Extoutbox::class);

        $validated = $request->validated();

        $extoutbox = Extoutbox::create($validated);

        return new ExtoutboxResource($extoutbox);
    }

    public function show(
        Request $request,
        Extoutbox $extoutbox
    ): ExtoutboxResource {
        $this->authorize('view', $extoutbox);

        return new ExtoutboxResource($extoutbox);
    }

    public function update(
        ExtoutboxUpdateRequest $request,
        Extoutbox $extoutbox
    ): ExtoutboxResource {
        $this->authorize('update', $extoutbox);

        $validated = $request->validated();

        $extoutbox->update($validated);

        return new ExtoutboxResource($extoutbox);
    }

    public function destroy(Request $request, Extoutbox $extoutbox): Response
    {
        $this->authorize('delete', $extoutbox);

        $extoutbox->delete();

        return response()->noContent();
    }
}
