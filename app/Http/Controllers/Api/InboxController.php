<?php

namespace App\Http\Controllers\Api;

use App\Models\Inbox;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\InboxResource;
use App\Http\Resources\InboxCollection;
use App\Http\Requests\InboxStoreRequest;
use App\Http\Requests\InboxUpdateRequest;

class InboxController extends Controller
{
    public function index(Request $request): InboxCollection
    {
        $this->authorize('view-any', Inbox::class);

        $search = $request->get('search', '');

        $inboxes = Inbox::search($search)
            ->latest()
            ->paginate();

        return new InboxCollection($inboxes);
    }

    public function store(InboxStoreRequest $request): InboxResource
    {
        $this->authorize('create', Inbox::class);

        $validated = $request->validated();

        $inbox = Inbox::create($validated);

        return new InboxResource($inbox);
    }

    public function show(Request $request, Inbox $inbox): InboxResource
    {
        $this->authorize('view', $inbox);

        return new InboxResource($inbox);
    }

    public function update(
        InboxUpdateRequest $request,
        Inbox $inbox
    ): InboxResource {
        $this->authorize('update', $inbox);

        $validated = $request->validated();

        $inbox->update($validated);

        return new InboxResource($inbox);
    }

    public function destroy(Request $request, Inbox $inbox): Response
    {
        $this->authorize('delete', $inbox);

        $inbox->delete();

        return response()->noContent();
    }
}
