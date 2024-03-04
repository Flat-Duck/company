<div>
    <div class="mb-4">
        @can('create', App\Models\Intoutbox::class)
        <button class="btn btn-primary" wire:click="newIntoutbox">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Intoutbox::class)
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

    <x-modal id="main-folder-intoutboxes-modal" wire:model="showingModal">
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
                            name="intoutbox.number"
                            label="Number"
                            wire:model="intoutbox.number"
                            maxlength="255"
                            placeholder="Number"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="intoutboxRegisteredAt"
                            label="Registered At"
                            wire:model="intoutboxRegisteredAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="intoutboxIssuedAt"
                            label="Issued At"
                            wire:model="intoutboxIssuedAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="intoutbox.sender"
                            label="Sender"
                            wire:model="intoutbox.sender"
                            maxlength="255"
                            placeholder="Sender"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="intoutbox.receiver"
                            label="Receiver"
                            wire:model="intoutbox.receiver"
                            maxlength="255"
                            placeholder="Receiver"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="intoutbox.subject"
                            label="Subject"
                            wire:model="intoutbox.subject"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="intoutbox.company_status"
                            label="Company Status"
                            wire:model="intoutbox.company_status"
                        >
                            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} ></option>
                            <option value=" قيد التشطيب" {{ $selected == ' قيد التشطيب' ? 'selected' : '' }} ></option>
                            <option value=" تم شطبها" {{ $selected == ' تم شطبها' ? 'selected' : '' }} ></option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="intoutbox.sub_folder_id"
                            label="Sub Folder"
                            wire:model="intoutbox.sub_folder_id"
                        >
                            <option value="null" disabled>Please select the Sub Folder</option>
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
                        @lang('crud.main_folder_intoutboxes.inputs.number')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.registered_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.issued_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.sender')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.receiver')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.subject')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.company_status')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_intoutboxes.inputs.sub_folder_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($intoutboxes as $intoutbox)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $intoutbox->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $intoutbox->number ?? '-' }}</td>
                    <td class="text-left">
                        {{ $intoutbox->registered_at ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $intoutbox->issued_at ?? '-' }}
                    </td>
                    <td class="text-left">{{ $intoutbox->sender ?? '-' }}</td>
                    <td class="text-left">{{ $intoutbox->receiver ?? '-' }}</td>
                    <td class="text-left">{{ $intoutbox->subject ?? '-' }}</td>
                    <td class="text-left">
                        {{ $intoutbox->company_status ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($intoutbox->subFolder)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $intoutbox)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editIntoutbox({{ $intoutbox->id }})"
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
                    <td colspan="9">{{ $intoutboxes->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
