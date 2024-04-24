@php $editing = isset($intoutbox) @endphp

<div class="row">
    <div class="mb-3 col-sm-12">
        <label class="form-label">{{trans('crud.intoutboxes.inputs.number')}}</label>
        <div class="input-group input-group-flat">
            <input name="number" type="text" 
            placeholder="{{trans('crud.intoutboxes.inputs.number')}}"
            value="{{old('number', ($editing ? $intoutbox->number : ''))}}"
            class="form-control text-end pe-0" 
            autocomplete="off" required >
            <span class="input-group-text">
                 / IEXP / 2024  
            </span>
        </div>
    </div>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="registered_at"
            label="{{trans('crud.intoutboxes.inputs.registered_at')}}"
            value="{{ old('registered_at', ($editing ? optional($intoutbox->registered_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="issued_at"
            label="{{trans('crud.intoutboxes.inputs.issued_at')}}"
            value="{{ old('issued_at', ($editing ? optional($intoutbox->issued_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="sender"
            label="{{trans('crud.intoutboxes.inputs.sender')}}"
            :value="old('sender', ($editing ? $intoutbox->sender : ''))"
            maxlength="255"
            placeholder="{{trans('crud.intoutboxes.inputs.sender')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="receiver"
            label="{{trans('crud.intoutboxes.inputs.receiver')}}"
            :value="old('receiver', ($editing ? $intoutbox->receiver : ''))"
            maxlength="255"
            placeholder="{{trans('crud.intoutboxes.inputs.receiver')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="subject"
            label="{{trans('crud.intoutboxes.inputs.subject')}}"
            maxlength="255"
            required
            >{{ old('subject', ($editing ? $intoutbox->subject : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="company_status" label="{{trans('crud.intoutboxes.inputs.company_status')}}">
            @php $selected = old('company_status', ($editing ? $intoutbox->company_status : 'قائمة')) @endphp
            <option value="لايوجد" {{ $selected == 'لايوجد' ? 'selected' : '' }} >لايوجد</option>
            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} ></option>
            <option value=" قيد التشطيب" {{ $selected == ' قيد التشطيب' ? 'selected' : '' }} ></option>
            <option value=" تم شطبها" {{ $selected == ' تم شطبها' ? 'selected' : '' }} ></option>
        </x-inputs.select>
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_folder_id" label="Main Folder" required>
            @php $selected = old('main_folder_id', ($editing ? $intoutbox->main_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Main Folder</option>
            @foreach($mainFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sub_folder_id" label="Sub Folder">
            @php $selected = old('sub_folder_id', ($editing ? $intoutbox->sub_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Sub Folder</option>
            @foreach($subFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> --}}

    @livewire('selects.main-folder-id-sub-folder-id-dependent-select', ['obj' => $editing ? $intoutbox : null])
</div>
