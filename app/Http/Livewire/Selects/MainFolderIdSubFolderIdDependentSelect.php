<?php

namespace App\Http\Livewire\Selects;

use App\Models\Memo;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainFolderIdSubFolderIdDependentSelect extends Component
{
    use AuthorizesRequests;

    public $allMainFolders;
    public $allSubFolders;

    public $selectedMainFolderId;
    public $selectedSubFolderId;

    protected $rules = [
        'selectedMainFolderId' => ['required', 'exists:main_folders,id'],
        'selectedSubFolderId' => ['nullable', 'exists:sub_folders,id'],
    ];

    public function mount($memo): void
    {
        $this->clearData();
        $this->fillAllMainFolders();

        if (is_null($memo)) {
            return;
        }

        $memo = Memo::findOrFail($memo);

        $this->selectedMainFolderId = $memo->main_folder_id;

        $this->fillAllSubFolders();
        $this->selectedSubFolderId = $memo->sub_folder_id;
    }

    public function updatedSelectedMainFolderId(): void
    {
        $this->selectedSubFolderId = null;
        $this->fillAllSubFolders();
    }

    public function fillAllMainFolders(): void
    {
        $this->allMainFolders = MainFolder::all()->pluck('name', 'id');
    }

    public function fillAllSubFolders(): void
    {
        if (!$this->selectedMainFolderId) {
            return;
        }

        $this->allSubFolders = SubFolder::where(
            'main_folder_id',
            $this->selectedMainFolderId
        )
            ->get()
            ->pluck('name', 'id');
    }

    public function clearData(): void
    {
        $this->allMainFolders = null;
        $this->allSubFolders = null;

        $this->selectedMainFolderId = null;
        $this->selectedSubFolderId = null;
    }

    public function render(): View
    {
        return view(
            'livewire.selects.main-folder-id-sub-folder-id-dependent-select'
        );
    }
}
