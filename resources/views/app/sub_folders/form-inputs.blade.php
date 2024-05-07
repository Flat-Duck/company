@php $editing = isset($subFolder) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="الإسم"
            :value="old('name', ($editing ? $subFolder->name : ''))"
            maxlength="255"
            placeholder="الإسم"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="main_folder_id" label="المجلد الرئيسي">
            @php $selected = old('main_folder_id', ($editing ? $subFolder->main_folder_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>الرجاء اختيار المجلد الرئيسي</option>
            @foreach($mainFolders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
