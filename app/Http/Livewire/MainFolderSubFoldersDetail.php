<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainFolderSubFoldersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public MainFolder $mainFolder;
    public SubFolder $subFolder;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New SubFolder';

    protected $rules = [
        'subFolder.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(MainFolder $mainFolder): void
    {
        $this->mainFolder = $mainFolder;
        $this->resetSubFolderData();
    }

    public function resetSubFolderData(): void
    {
        $this->subFolder = new SubFolder();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSubFolder(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.main_folder_sub_folders.new_title');
        $this->resetSubFolderData();

        $this->showModal();
    }

    public function editSubFolder(SubFolder $subFolder): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.main_folder_sub_folders.edit_title');
        $this->subFolder = $subFolder;

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

        if (!$this->subFolder->main_folder_id) {
            $this->authorize('create', SubFolder::class);

            $this->subFolder->main_folder_id = $this->mainFolder->id;
        } else {
            $this->authorize('update', $this->subFolder);
        }

        $this->subFolder->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', SubFolder::class);

        SubFolder::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSubFolderData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mainFolder->subFolders as $subFolder) {
            array_push($this->selected, $subFolder->id);
        }
    }

    public function render(): View
    {
        return view('livewire.main-folder-sub-folders-detail', [
            'subFolders' => $this->mainFolder->subFolders()->paginate(20),
        ]);
    }
}
