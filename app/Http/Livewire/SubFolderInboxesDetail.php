<?php

namespace App\Http\Livewire;

use App\Models\Inbox;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubFolderInboxesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public SubFolder $subFolder;
    public Inbox $inbox;
    public $mainFoldersForSelect = [];
    public $inboxRegisteredAt;
    public $inboxIssuedAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Inbox';

    protected $rules = [
        'inbox.number' => ['required', 'max:255', 'string'],
        'inboxRegisteredAt' => ['required', 'date'],
        'inboxIssuedAt' => ['required', 'date'],
        'inbox.sender' => ['required', 'max:255', 'string'],
        'inbox.receiver' => ['required', 'max:255', 'string'],
        'inbox.subject' => ['required', 'max:255', 'string'],
        'inbox.type' => ['required', 'in:طلب,شخصي,أخرى,لا يوجد'],
        'inbox.company_status' => ['nullable', 'in:قائمة,قيد التشطيب,تم شطبها'],
        'inbox.main_folder_id' => ['required', 'exists:main_folders,id'],
    ];

    public function mount(SubFolder $subFolder): void
    {
        $this->subFolder = $subFolder;
        $this->mainFoldersForSelect = MainFolder::pluck('name', 'id');
        $this->resetInboxData();
    }

    public function resetInboxData(): void
    {
        $this->inbox = new Inbox();

        $this->inboxRegisteredAt = null;
        $this->inboxIssuedAt = null;
        $this->inbox->type = 'لا يوجد';
        $this->inbox->company_status = 'قائمة';
        $this->inbox->main_folder_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newInbox(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.sub_folder_inboxes.new_title');
        $this->resetInboxData();

        $this->showModal();
    }

    public function editInbox(Inbox $inbox): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.sub_folder_inboxes.edit_title');
        $this->inbox = $inbox;

        $this->inboxRegisteredAt = optional(
            $this->inbox->registered_at
        )->format('Y-m-d');
        $this->inboxIssuedAt = optional($this->inbox->issued_at)->format(
            'Y-m-d'
        );

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->inbox->sub_folder_id) {
            $this->authorize('create', Inbox::class);

            $this->inbox->sub_folder_id = $this->subFolder->id;
        } else {
            $this->authorize('update', $this->inbox);
        }

        $this->inbox->registered_at = \Carbon\Carbon::make(
            $this->inboxRegisteredAt
        );
        $this->inbox->issued_at = \Carbon\Carbon::make($this->inboxIssuedAt);

        $this->inbox->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Inbox::class);

        Inbox::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetInboxData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->subFolder->inboxes as $inbox) {
            array_push($this->selected, $inbox->id);
        }
    }

    public function render(): View
    {
        return view('livewire.sub-folder-inboxes-detail', [
            'inboxes' => $this->subFolder->inboxes()->paginate(20),
        ]);
    }
}
