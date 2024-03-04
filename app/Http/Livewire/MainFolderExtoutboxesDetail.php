<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Extoutbox;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainFolderExtoutboxesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public MainFolder $mainFolder;
    public Extoutbox $extoutbox;
    public $subFoldersForSelect = [];
    public $extoutboxRegisteredAt;
    public $extoutboxIssuedAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Extoutbox';

    protected $rules = [
        'extoutbox.number' => ['required', 'max:255', 'string'],
        'extoutboxRegisteredAt' => ['required', 'date'],
        'extoutboxIssuedAt' => ['required', 'date'],
        'extoutbox.sender' => ['required', 'max:255', 'string'],
        'extoutbox.receiver' => ['required', 'max:255', 'string'],
        'extoutbox.subject' => ['required', 'max:255', 'string'],
        'extoutbox.company_status' => [
            'nullable',
            'in:قائمة,قيد التشطيب,تم شطبها',
        ],
        'extoutbox.sub_folder_id' => ['required', 'exists:sub_folders,id'],
    ];

    public function mount(MainFolder $mainFolder): void
    {
        $this->mainFolder = $mainFolder;
        $this->subFoldersForSelect = SubFolder::pluck('name', 'id');
        $this->resetExtoutboxData();
    }

    public function resetExtoutboxData(): void
    {
        $this->extoutbox = new Extoutbox();

        $this->extoutboxRegisteredAt = null;
        $this->extoutboxIssuedAt = null;
        $this->extoutbox->company_status = 'قائمة';
        $this->extoutbox->sub_folder_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newExtoutbox(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.main_folder_extoutboxes.new_title');
        $this->resetExtoutboxData();

        $this->showModal();
    }

    public function editExtoutbox(Extoutbox $extoutbox): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.main_folder_extoutboxes.edit_title');
        $this->extoutbox = $extoutbox;

        $this->extoutboxRegisteredAt = optional(
            $this->extoutbox->registered_at
        )->format('Y-m-d');
        $this->extoutboxIssuedAt = optional(
            $this->extoutbox->issued_at
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

        if (!$this->extoutbox->main_folder_id) {
            $this->authorize('create', Extoutbox::class);

            $this->extoutbox->main_folder_id = $this->mainFolder->id;
        } else {
            $this->authorize('update', $this->extoutbox);
        }

        $this->extoutbox->registered_at = \Carbon\Carbon::make(
            $this->extoutboxRegisteredAt
        );
        $this->extoutbox->issued_at = \Carbon\Carbon::make(
            $this->extoutboxIssuedAt
        );

        $this->extoutbox->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Extoutbox::class);

        Extoutbox::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetExtoutboxData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mainFolder->extoutboxes as $extoutbox) {
            array_push($this->selected, $extoutbox->id);
        }
    }

    public function render(): View
    {
        return view('livewire.main-folder-extoutboxes-detail', [
            'extoutboxes' => $this->mainFolder->extoutboxes()->paginate(20),
        ]);
    }
}
