<div>
    <div class="mb-4">
        @can('create', App\Models\Attachment::class)
        <button class="btn btn-primary" wire:click="newAttachment">
            <i class="ti ti-plus"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Attachment::class)
        <button class="btn btn-danger" {{ empty($selected) ? 'disabled' : '' }}  onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="destroySelected" >
            <i class="ti ti-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="int                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      outbox-attachments-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="btn-close close"
                    data-dismiss="modal"
                    aria-label="Close"
                    data-bs-dismiss="modal"
                    >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="attachment.name"
                            label="إسم الملف"
                            wire:model="attachment.name"
                            maxlength="255"
                            placeholder="إسم الملف"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <label name="attachmentFile"  for="attachmentFile{{ $uploadIteration }}">File</label>                        
                        <input
                            type="file"
                            name="attachmentFile"
                            id="attachmentFile{{ $uploadIteration }}"
                            wire:model="attachmentFile"
                            class="form-control-file" />

                        @if($editing && $attachment->file)
                        <div class="mt-2">
                            <a
                                href="{{ \Storage::url($attachment->file) }}"
                                target="_blank" ><i class="ti ti-download"></i>&nbsp;Download</a
                            >
                        </div>
                        @endif @error('attachmentFile')
                        @include('components.inputs.partials.error') @enderror
                    </x-inputs.group>
                </div>
            </div>

            {{-- @if($editing) @endif --}}

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn me-auto"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="ti ti-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="ti ti-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.int                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      outbox_attachments.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.int                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      outbox_attachments.inputs.file')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($attachments as $attachment)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $attachment->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $attachment->name ?? '-' }}</td>
                    <td class="text-left">
                        @if($attachment->file)
                        <a
                            href="{{ \Storage::url($attachment->file) }}"
                            target="blank"
                            ><i class="ti ti-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $attachment)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editAttachment({{ $attachment->id }})"
                            >
                                <i class="ti ti-file-plus"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">{{ $attachments->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
