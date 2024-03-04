<?php

namespace App\Http\Livewire\Selects;

use App\Models\Extoutbox;
use App\Models\Inbox;
use App\Models\Intoutbox;
use App\Models\MainFolder;
use App\Models\Memo;
use App\Models\SubFolder;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

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

    public function mount($obj): void
    {
        $this->clearData();
        $this->fillAllMainFolders();

        if (is_null($obj)) {
            return;
        }
        
        if ($obj instanceof Extoutbox) {
            
            $obj = Extoutbox::findOrFail($obj);

        } elseif ($obj instanceof Intoutbox) {
            
            $obj = Intoutbox::findOrFail($obj);

        } elseif ($obj instanceof Inbox) {
            
            $obj = Inbox::findOrFail($obj);
        
        } elseif ($obj instanceof Memo) {
            
            $obj = Memo::findOrFail($obj);
        
        }

        

        $this->selectedMainFolderId = $obj->main_folder_id;

        $this->fillAllSubFolders();
        $this->selectedSubFolderId = $obj->sub_folder_id;
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
