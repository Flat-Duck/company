<?php

namespace App\Http\Livewire;

use App\Models\Memo;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\SubFolder;
use App\Models\MainFolder;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainFolderMemosDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public MainFolder $mainFolder;
    public Memo $memo;
    public $subFoldersForSelect = [];
    public $memoRegisteredAt;
    public $memoIssuedAt;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Memo';

    protected $rules = [
        'memo.number' => ['required', 'max:255', 'string'],
        'memoRegisteredAt' => ['required', 'date'],
        'memoIssuedAt' => ['required', 'date'],
        'memo.type' => ['required', 'max:255', 'string'],
        'memo.subject' => ['required', 'max:255', 'string'],
        'memo.sub_folder_id' => ['nullable', 'exists:sub_folders,id'],
    ];

    public function mount(MainFolder $mainFolder): void
    {
        $this->mainFolder = $mainFolder;
        $this->subFoldersForSelect = SubFolder::pluck('name', 'id');
        $this->resetMemoData();
    }

    public function resetMemoData(): void
    {
        $this->memo = new Memo();

        $this->memoRegisteredAt = null;
        $this->memoIssuedAt = null;
        $this->memo->sub_folder_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newMemo(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.main_folder_memos.new_title');
        $this->resetMemoData();

        $this->showModal();
    }

    public function editMemo(Memo $memo): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.main_folder_memos.edit_title');
        $this->memo = $memo;

        $this->memoRegisteredAt = optional($this->memo->registered_at)->format(
            'Y-m-d'
        );
        $this->memoIssuedAt = optional($this->memo->issued_at)->format('Y-m-d');

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

        if (!$this->memo->main_folder_id) {
            $this->authorize('create', Memo::class);

            $this->memo->main_folder_id = $this->mainFolder->id;
        } else {
            $this->authorize('update', $this->memo);
        }

        $this->memo->registered_at = \Carbon\Carbon::make(
            $this->memoRegisteredAt
        );
        $this->memo->issued_at = \Carbon\Carbon::make($this->memoIssuedAt);

        $this->memo->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Memo::class);

        Memo::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetMemoData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->mainFolder->memos as $memo) {
            array_push($this->selected, $memo->id);
        }
    }

    public function render(): View
    {
        return view('livewire.main-folder-memos-detail', [
            'memos' => $this->mainFolder->memos()->paginate(20),
        ]);
    }
}
