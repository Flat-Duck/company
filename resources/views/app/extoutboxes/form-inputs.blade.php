@php $editing = isset($extoutbox) @endphp

<div class="row">
    <div class="mb-3 col-sm-12">
        <label class="form-label">{{trans('crud.extoutboxes.inputs.number')}}</label>
        <div class="input-group input-group-flat">
            <span class="input-group-text">
                {{ $editing? $extoutbox->number : App\Models\Extoutbox::GetFullCode() }}
            </span>
            <input name="display" type="text" readonly value="" class="form-control text-end pe-0" autocomplete="off">
        </div>
    </div>
    <input type="hidden" value="{{ $editing? $extoutbox->number : App\Models\Extoutbox::GetFullCode() }}" name="number">
    

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
        <x-inputs.select name="sender" label="{{trans('crud.extoutboxes.inputs.sender')}}" required>
            @php $selected = old('sender', ($editing ? $extoutbox->sender : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المرسل</option>
            @foreach($fromTo as $value => $label)
            <option value="{{ $label }}" {{ $selected == $label ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="receiver" label="{{trans('crud.extoutboxes.inputs.receiver')}}" required>
            @php $selected = old('receiver', ($editing ? $extoutbox->receiver : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المتلقي</option>
            @foreach($fromTo as $value => $label)
            <option value="{{ $label }}" {{ $selected == $label ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
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
            <option value="لا يوجد" {{ $selected == 'لا يوجد' ? 'selected' : '' }} >لا يوجد</option>
            <option value="قائمة" {{ $selected == 'قائمة' ? 'selected' : '' }} >قائمة</option>
            <option value="قيد التشطيب" {{ $selected == 'قيد التشطيب' ? 'selected' : '' }} >قيد التشطيب</option>
            <option value="تم شطبها" {{ $selected == 'تم شطبها' ? 'selected' : '' }} >تم شطبها</option>
        </x-inputs.select>
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_folder_id" label="المجلد الرئيسي" required>
            @php $selected = old('main_folder_id', ($editing ? $extoutbox->main_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المجلد الرئيسي</option>
            @foreach($mainFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sub_folder_id" label="المجلد الفرعي" required>
            @php $selected = old('sub_folder_id', ($editing ? $extoutbox->sub_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المجلد الفرعي</option>
            @foreach($subFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> --}}

    @livewire('selects.main-folder-id-sub-folder-id-dependent-select', [ 'obj' => $editing ? $extoutbox : null])
</div>
