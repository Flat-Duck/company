<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Intoutbox;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainFolderIntoutboxesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public MainFolder $mainFolder;
    public Intoutbox $intoutbox;
    public $subFoldersForSelect = [];
    public $intoutboxRegisteredAt;
    public $intoutboxIssuedAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Intoutbox';

    protected $rules = [
        'intoutbox.number' => ['required', 'max:255', 'string'],
        'intoutboxRegisteredAt' => ['required', 'date'],
        'intoutboxIssuedAt' => ['required', 'date'],
        'intoutbox.sender' => ['required', 'max:255', 'string'],
        'intoutbox.receiver' => ['required', 'max:255', 'string'],
        'intoutbox.subject' => ['required', 'max:255', 'string'],
        'intoutbox.company_status' => [
            'nullable',
            'in:قائمة,قيد التشطيب,تم شطبها',
        ],
        'intoutbox.sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
    ];

    public function mount(MainFolder $mainFolder): void
    {
        $this->mainFolder = $mainFolder;
        $this->subFoldersForSelect = SubFolder::pluck('name', 'id');
        $this->resetIntoutboxData();
    }

    public function resetIntoutboxData(): void
    {
        $this->intoutbox = new Intoutbox();

        $this->intoutboxRegisteredAt = null;
        $this->intoutboxIssuedAt = null;
        $this->intoutbox->company_status = 'قائمة';
        $this->intoutbox->sub_folder_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newIntoutbox(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.main_folder_intoutboxes.new_title');
        $this->resetIntoutboxData();

        $this->showModal();
    }

    public function editIntoutbox(Intoutbox $intoutbox): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.main_folder_intoutboxes.edit_title');
        $this->intoutbox = $intoutbox;

        $this->intoutboxRegisteredAt = optional(
            $this->intoutbox->registered_at
        )->format('Y-m-d');
        $this->intoutboxIssuedAt = optional(
            $this->intoutbox->issued_at
        )->format('Y-m-d');

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

        if (!$this->intoutbox->main_folder_id) {
            $this->authorize('create', Intoutbox::class);

            $this->intoutbox->main_folder_id = $this->mainFolder->id;
        } else {
            $this->authorize('update', $this->intoutbox);
        }

        $this->intoutbox->registered_at = \Carbon\Carbon::make(
            $this->intoutboxRegisteredAt
        );
        $this->intoutbox->issued_at = \Carbon\Carbon::make(
            $this->intoutboxIssuedAt
        );

        $this->intoutbox->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Intoutbox::class);

        Intoutbox::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetIntoutboxData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mainFolder->intoutboxes as $intoutbox) {
            array_push($this->selected, $intoutbox->id);
        }
    }

    public function render(): View
    {
        return view('livewire.main-folder-intoutboxes-detail', [
            'intoutboxes' => $this->mainFolder->intoutboxes()->paginate(20),
        ]);
    }
}
