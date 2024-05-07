@php $editing = isset($office) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="الإسم"
            :value="old('name', ($editing ? $office->name : ''))"
            maxlength="255"
            placeholder="الإسم"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
