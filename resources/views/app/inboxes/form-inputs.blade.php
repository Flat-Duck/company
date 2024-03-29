@php $editing = isset($inbox) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="number"
            label="{{trans('crud.inboxes.inputs.number')}}"
            :value="old('number', ($editing ? $inbox->number : ''))"
            maxlength="255"
            placeholder="{{trans('crud.inboxes.inputs.number')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="registered_at"
            label="{{trans('crud.inboxes.inputs.registered_at')}}"
            value="{{ old('registered_at', ($editing ? optional($inbox->registered_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="issued_at"
            label="{{trans('crud.inboxes.inputs.issued_at')}}"
            value="{{ old('issued_at', ($editing ? optional($inbox->issued_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="sender"
            label="{{trans('crud.inboxes.inputs.sender')}}"
            :value="old('sender', ($editing ? $inbox->sender : ''))"
            maxlength="255"
            placeholder="{{trans('crud.inboxes.inputs.sender')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="receiver"
            label="{{trans('crud.inboxes.inputs.receiver')}}"
            :value="old('receiver', ($editing ? $inbox->receiver : ''))"
            maxlength="255"
            placeholder="{{trans('crud.inboxes.inputs.receiver')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="subject"
            label="{{trans('crud.inboxes.inputs.subject')}}"
            maxlength="255"
            required
            >{{ old('subject', ($editing ? $inbox->subject : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type" label="{{trans('crud.inboxes.inputs.type')}}">
            @php $selected = old('type', ($editing ? $inbox->type : 'شخصي')) @endphp
            <option value="شخصي" {{ $selected == 'شخصي' ? 'selected' : '' }} ></option>
            <option value="طلب" {{ $selected == 'طلب' ? 'selected' : '' }} ></option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="company_status" label="{{trans('crud.inboxes.inputs.company_status')}}">
            @php $selected = old('company_status', ($editing ? $inbox->company_status : 'قائمة')) @endphp
            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} ></option>
            <option value="قيد التشطيب" {{ $selected == 'قيد التشطيب' ? 'selected' : '' }} ></option>
            <option value="تم شطبها" {{ $selected == 'تم شطبها' ? 'selected' : '' }} ></option>
        </x-inputs.select>
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_folder_id" label="Main Folder" required>
            @php $selected = old('main_folder_id', ($editing ? $inbox->main_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Main Folder</option>
            @foreach($mainFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sub_folder_id" label="Sub Folder">
            @php $selected = old('sub_folder_id', ($editing ? $inbox->sub_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sub Folder</option>
            @foreach($subFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> --}}

    @livewire('selects.main-folder-id-sub-folder-id-dependent-select', [ 'obj' => $editing ? $inbox->id : null])
</div>
