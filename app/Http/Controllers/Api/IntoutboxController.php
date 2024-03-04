<?php

namespace App\Http\Controllers\Api;

use App\Models\Intoutbox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntoutboxResource;
use App\Http\Resources\IntoutboxCollection;
use App\Http\Requests\IntoutboxStoreRequest;
use App\Http\Requests\IntoutboxUpdateRequest;

class IntoutboxController extends Controller
{
    public function index(Request $request): IntoutboxCollection
    {
        $this->authorize('view-any', Intoutbox::class);

        $search = $request->get('search', '');

        $intoutboxes = Intoutbox::search($search)
            ->latest()
            ->paginate();

        return new IntoutboxCollection($intoutboxes);
    }

    public function store(IntoutboxStoreRequest $request): IntoutboxResource
    {
        $this->authorize('create', Intoutbox::class);

        $validated = $request->validated();

        $intoutbox = Intoutbox::create($validated);

        return new IntoutboxResource($intoutbox);
    }

    public function show(
        Request $request,
        Intoutbox $intoutbox
    ): IntoutboxResource {
        $this->authorize('view', $intoutbox);

        return new IntoutboxResource($intoutbox);
    }

    public function update(
        IntoutboxUpdateRequest $request,
        Intoutbox $intoutbox
    ): IntoutboxResource {
        $this->authorize('update', $intoutbox);

        $validated = $request->validated();

        $intoutbox->update($validated);

        return new IntoutboxResource($intoutbox);
    }

    public function destroy(Request $request, Intoutbox $intoutbox): Response
    {
        $this->authorize('delete', $intoutbox);

        $intoutbox->delete();

        return response()->noContent();
    }
}
