<div>
    <div class="mb-4">
        @can('create', App\Models\Extoutbox::class)
        <button class="btn btn-primary" wire:click="newExtoutbox">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Extoutbox::class)
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

    <x-modal id="main-folder-extoutboxes-modal" wire:model="showingModal">
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
                            name="extoutbox.number"
                            label="Number"
                            wire:model="extoutbox.number"
                            maxlength="255"
                            placeholder="Number"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="extoutboxRegisteredAt"
                            label="Registered At"
                            wire:model="extoutboxRegisteredAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="extoutboxIssuedAt"
                            label="Issued At"
                            wire:model="extoutboxIssuedAt"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="extoutbox.sender"
                            label="Sender"
                            wire:model="extoutbox.sender"
                            maxlength="255"
                            placeholder="Sender"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="extoutbox.receiver"
                            label="{{trans('crud.inboxes.inputs.receiver')}}"
                            wire:model="extoutbox.receiver"
                            maxlength="255"
                            placeholder="{{trans('crud.inboxes.inputs.receiver')}}"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="extoutbox.subject"
                            label="Subject"
                            wire:model="extoutbox.subject"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="extoutbox.company_status"
                            label="Company Status"
                            wire:model="extoutbox.company_status"
                        >
                        <option value="لا يوجد" {{ $selected == 'لا يوجد' ? 'selected' : '' }} >لا يوجد</option>
                            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} >قائمة</option>
                            <option value="قيد التشطيب" {{ $selected == ' قيد التشطيب' ? 'selected' : '' }} >قيد التشطيب</option>
                            <option value="تم شطبها" {{ $selected == ' تم شطبها' ? 'selected' : '' }} >تم شطبها</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="extoutbox.sub_folder_id"
                            label="Sub Folder"
                            wire:model="extoutbox.sub_folder_id"
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
                        @lang('crud.main_folder_extoutboxes.inputs.number')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.registered_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.issued_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.sender')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.receiver')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.subject')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.company_status')
                    </th>
                    <th class="text-left">
                        @lang('crud.main_folder_extoutboxes.inputs.sub_folder_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($extoutboxes as $extoutbox)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $extoutbox->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $extoutbox->number ?? '-' }}</td>
                    <td class="text-left">
                        {{ $extoutbox->registered_at ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ $extoutbox->issued_at ?? '-' }}
                    </td>
                    <td class="text-left">{{ $extoutbox->sender ?? '-' }}</td>
                    <td class="text-left">{{ $extoutbox->receiver ?? '-' }}</td>
                    <td class="text-left">{{ $extoutbox->subject ?? '-' }}</td>
                    <td class="text-left">
                        {{ $extoutbox->company_status ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($extoutbox->subFolder)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $extoutbox)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editExtoutbox({{ $extoutbox->id }})"
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
                    <td colspan="9">{{ $extoutboxes->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
