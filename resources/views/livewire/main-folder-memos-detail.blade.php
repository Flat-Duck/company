<div>
    <div class="mb-4">
        @can('create', App\Models\Memo::class)
        <button class="btn btn-primary" wire:click="newMemo">
            <i class="ti ti-plus"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Memo::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="ti ti-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="main-folder-memos-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="memo.number"
                            label="Number"
                            wire:model="memo.number"
                            maxlength="255"
                            placeholder="Number"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="memoRegisteredAt"
                            label="Registered At"
                            wire:model="memoRegisteredAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="memoIssuedAt"
                            label="Issued At"
                            wire:model="memoIssuedAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="memo.type"
                            label="Type"
                            wire:model="memo.type"
                            maxlength="255"
                            placeholder="Type"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="memo.subject"
                            label="Subject"
                            wire:model="memo.subject"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="memo.sub_folder_id"
                            label="المجلد الفرعي"
                            wire:model="memo.sub_folder_id"
                        >
                            <option value="null" disabled>الرجاء اختيار المجلد الفرعي</option>
                            @foreach($subFoldersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
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
        <table class="table table-borderless table-hover">
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
                        @lang('crud.main_folder_memos.inputs.number')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_memos.inputs.registered_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_memos.inputs.issued_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_memos.inputs.type')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_memos.inputs.subject')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_memos.inputs.sub_folder_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($memos as $memo)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $memo->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $memo->number ?? '-' }}</td>
                    <td class="text-left">{{ $memo->registered_at->format('Y-d-m')?? '-' }}</td>
                    <td class="text-left">{{ $memo->issued_at->format('Y-d-m') ?? '-' }}</td>
                    <td class="text-left">{{ $memo->type ?? '-' }}</td>
                    <td class="text-left">{{ $memo->subject ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($memo->subFolder)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $memo)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editMemo({{ $memo->id }})"
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
                    <td colspan="7">{{ $memos->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
