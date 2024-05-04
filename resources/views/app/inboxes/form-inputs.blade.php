@php $editing = isset($inbox) @endphp

<div class="row">
    <div class="mb-3 col-sm-12">
        <label class="form-label">{{trans('crud.inboxes.inputs.number')}}</label>
        <div class="input-group input-group-flat">
            <input name="number" type="text" 
            placeholder="{{trans('crud.inboxes.inputs.number')}}"
            value="{{old('number', ($editing ? $inbox->number : ''))}}"
            class="form-control text-end pe-0" 
            autocomplete="off" required >
            <span class="input-group-text">
                @if(!$editing)
                {{ App\Models\Inbox::GetFullCode() }}
             @endif
            </span>
        </div>
    </div>

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
            @php $selected = old('type', ($editing ? $inbox->type : 'لا يوجد')) @endphp
            <option value="طلب شخصي" {{ $selected == 'طلب شخصي' ? 'selected' : '' }} >طلب شخصي</option>
            <option value="أخرى" {{ $selected == 'أخرى' ? 'selected' : '' }} >أخرى</option>
            <option value="لا يوجد" {{ $selected == 'لا يوجد' ? 'selected' : '' }} >لا يوجد</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="company_status" label="{{trans('crud.inboxes.inputs.company_status')}}">
            @php $selected = old('company_status', ($editing ? $inbox->company_status : 'قائمة')) @endphp
            <option value="لا يوجد" {{ $selected == 'لا يوجد' ? 'selected' : '' }} >لا يوجد</option>
            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} >قائمة</option>
            <option value="قيد التشطيب" {{ $selected == 'قيد التشطيب' ? 'selected' : '' }} >قيد التشطيب</option>
            <option value="تم شطبها" {{ $selected == 'تم شطبها' ? 'selected' : '' }} >تم شطبها</option>
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

    @livewire('selects.main-folder-id-sub-folder-id-dependent-select', [ 'obj' => $editing ? $inbox : null])
</div>
