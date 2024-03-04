<div>
    <div class="mb-4">
        @can('create', App\Models\Inbox::class)
        <button class="btn btn-primary" wire:click="newInbox">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Inbox::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="sub-folder-inboxes-modal" wire:model="showingModal">
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
                            name="inbox.number"
                            label="Number"
                            wire:model="inbox.number"
                            maxlength="255"
                            placeholder="Number"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="inboxRegisteredAt"
                            label="Registered At"
                            wire:model="inboxRegisteredAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="inboxIssuedAt"
                            label="Issued At"
                            wire:model="inboxIssuedAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="inbox.sender"
                            label="Sender"
                            wire:model="inbox.sender"
                            maxlength="255"
                            placeholder="Sender"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="inbox.receiver"
                            label="{{trans('crud.inboxes.inputs.receiver')}}"
                            wire:model="inbox.receiver"
                            maxlength="255"
                            placeholder="{{trans('crud.inboxes.inputs.receiver')}}"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="inbox.subject"
                            label="Subject"
                            wire:model="inbox.subject"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="inbox.type"
                            label="Type"
                            wire:model="inbox.type"
                        >
                            <option value="شخصي" {{ $selected == 'شخصي' ? 'selected' : '' }} ></option>
                            <option value="طلب" {{ $selected == 'طلب' ? 'selected' : '' }} ></option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="inbox.company_status"
                            label="Company Status"
                            wire:model="inbox.company_status"
                        >
                            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} ></option>
                            <option value="قيد التشطيب" {{ $selected == 'قيد التشطيب' ? 'selected' : '' }} ></option>
                            <option value="تم شطبها" {{ $selected == 'تم شطبها' ? 'selected' : '' }} ></option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="inbox.main_folder_id"
                            label="Main Folder"
                            wire:model="inbox.main_folder_id"
                        >
                            <option value="null" disabled>Please select the Main Folder</option>
                            @foreach($mainFoldersForSelect as $value => $label)
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
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
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
                        @lang('crud.sub_folder_inboxes.inputs.number')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.registered_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.issued_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.sender')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.receiver')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.subject')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.type')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.company_status')
                    </th>
                    <th class="text-left">
                        @lang('crud.sub_folder_inboxes.inputs.main_folder_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($inboxes as $inbox)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $inbox->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $inbox->number ?? '-' }}</td>
                    <td class="text-left">
                        {{ $inbox->registered_at ?? '-' }}
                    </td>
                    <td class="text-left">{{ $inbox->issued_at ?? '-' }}</td>
                    <td class="text-left">{{ $inbox->sender ?? '-' }}</td>
                    <td class="text-left">{{ $inbox->receiver ?? '-' }}</td>
                    <td class="text-left">{{ $inbox->subject ?? '-' }}</td>
                    <td class="text-left">{{ $inbox->type ?? '-' }}</td>
                    <td class="text-left">
                        {{ $inbox->company_status ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($inbox->mainFolder)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $inbox)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editInbox({{ $inbox->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">{{ $inboxes->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
