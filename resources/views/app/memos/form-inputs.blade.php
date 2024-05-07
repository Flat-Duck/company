@php $editing = isset($memo) @endphp

<div class="row">
    <div class="mb-3 col-sm-12">
    <label class="form-label">{{trans('crud.memos.inputs.number')}}</label>
        <div class="input-group input-group-flat">
            <span class="input-group-text">
                {{ $editing? $memo->number : App\Models\Memo::GetFullCode() }}
            </span>
            <input name="display" type="text" readonly value="" class="form-control text-end pe-0" autocomplete="off">
        </div>
    </div>
    <input type="hidden" value="{{ $editing? $memo->number : App\Models\Memo::GetFullCode() }}" name="number">

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="registered_at"
            label="{{trans('crud.memos.inputs.registered_at')}}"
            value="{{ old('registered_at', ($editing ? optional($memo->registered_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="issued_at"
            label="{{trans('crud.memos.inputs.issued_at')}}"
            value="{{ old('issued_at', ($editing ? optional($memo->issued_at)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="type"
            label="{{trans('crud.memos.inputs.type')}}"
            :value="old('type', ($editing ? $memo->type : ''))"
            maxlength="255"
            placeholder="{{trans('crud.memos.inputs.type')}}"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="subject"
            label="{{trans('crud.memos.inputs.subject')}}"
            maxlength="255"
            required
            >{{ old('subject', ($editing ? $memo->subject : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    {{-- <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_folder_id" label="{{trans('crud.memos.inputs.main_folder_id')}}" required>
            @php $selected = old('main_folder_id', ($editing ? $memo->main_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المجلد الرئيسي</option>
            @foreach($mainFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="sub_folder_id" label="{{trans('crud.memos.inputs.sub_folder_id')}}">
            @php $selected = old('sub_folder_id', ($editing ? $memo->sub_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المجلد الفرعي</option>
            @foreach($subFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group> --}}

    @livewire('selects.main-folder-id-sub-folder-id-dependent-select', ['obj' => $editing ? $memo : null])
</div>
