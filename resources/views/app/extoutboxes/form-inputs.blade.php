@php $editing = isset($extoutbox) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="number"
            label="{{trans('crud.extoutboxes.inputs.number')}}"
            :value="old('number', ($editing ? $extoutbox->number : ''))"
            maxlength="255"
            placeholder="{{trans('crud.extoutboxes.inputs.number')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="registered_at"
            label="{{trans('crud.extoutboxes.inputs.registered_at')}}"
            value="{{ old('registered_at', ($editing ? optional($extoutbox->registered_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="issued_at"
            label="{{trans('crud.extoutboxes.inputs.issued_at')}}"
            value="{{ old('issued_at', ($editing ? optional($extoutbox->issued_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="sender"
            label="{{trans('crud.extoutboxes.inputs.sender')}}"
            :value="old('sender', ($editing ? $extoutbox->sender : ''))"
            maxlength="255"
            placeholder="{{trans('crud.extoutboxes.inputs.sender')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="receiver"
            label="{{trans('crud.extoutboxes.inputs.receiver')}}"
            :value="old('receiver', ($editing ? $extoutbox->receiver : ''))"
            maxlength="255"
            placeholder="{{trans('crud.extoutboxes.inputs.receiver')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="subject"
            label="{{trans('crud.extoutboxes.inputs.subject')}}"
            maxlength="255"
            required
            >{{ old('subject', ($editing ? $extoutbox->subject : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="company_status" label="{{trans('crud.extoutboxes.inputs.company_status')}}">
            @php $selected = old('company_status', ($editing ? $extoutbox->company_status : 'قائمة')) @endphp
            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} >قائمة</option>
            <option value="قيد التشطيب" {{ $selected == 'قيد التشطيب' ? 'selected' : '' }} >قيد التشطيب</option>
            <option value="تم شطبها" {{ $selected == 'تم شطبها' ? 'selected' : '' }} >تم شطبها</option>
        </x-inputs.select>
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_folder_id" label="Main Folder" required>
            @php $selected = old('main_folder_id', ($editing ? $extoutbox->main_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Main Folder</option>
            @foreach($mainFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sub_folder_id" label="Sub Folder" required>
            @php $selected = old('sub_folder_id', ($editing ? $extoutbox->sub_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sub Folder</option>
            @foreach($subFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> --}}

    @livewire('selects.main-folder-id-sub-folder-id-dependent-select', [ 'obj' => $editing ? $extoutbox->id : null])
</div>
