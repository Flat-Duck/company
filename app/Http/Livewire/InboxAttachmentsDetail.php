<?php

namespace App\Http\Livewire;

use App\Models\Inbox;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Attachment;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InboxAttachmentsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Inbox $inbox;
    public Attachment $attachment;
    public $attachmentFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Attachment';

    protected $rules = [
        'attachment.name' => ['required', 'max:255', 'string'],
        'attachmentFile' => ['nullable', 'file'],
    ];

    public function mount(Inbox $inbox): void
    {
        $this->inbox = $inbox;
        $this->resetAttachmentData();
    }

    public function resetAttachmentData(): void
    {
        $this->attachment = new Attachment();

        $this->attachmentFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAttachment(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.inbox_attachments.new_title');
        $this->resetAttachmentData();

        $this->showModal();
    }

    public function editAttachment(Attachment $attachment): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.inbox_attachments.edit_title');
        $this->attachment = $attachment;

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

        if (!$this->attachment->inbox_id) {
            $this->authorize('create', Attachment::class);

            $this->attachment->inbox_id = $this->inbox->id;
        } else {
            $this->authorize('update', $this->attachment);
        }

        if ($this->attachmentFile) {
            $this->attachment->file = $this->attachmentFile->store('public');
        }

        $this->attachment->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Attachment::class);

        collect($this->selected)->each(function (string $id) {
            $attachment = Attachment::findOrFail($id);

            if ($attachment->file) {
                Storage::delete($attachment->file);
            }

            $attachment->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAttachmentData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->inbox->attachments as $attachment) {
            array_push($this->selected, $attachment->id);
        }
    }

    public function render(): View
    {
        return view('livewire.inbox-attachments-detail', [
            'attachments' => $this->inbox->attachments()->paginate(20),
        ]);
    }
}
