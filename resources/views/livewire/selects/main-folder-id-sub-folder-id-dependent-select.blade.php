<div class="w-100 p-0">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="main_folder_id"
            label="{{trans('crud.extoutboxes.inputs.main_folder_id')}}"
            wire:model="selectedMainFolderId">
            <option selected>الرجاء اختيار المجلد الرئيسي</option>
            @foreach($allMainFolders as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    @if(!empty($selectedMainFolderId))
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="sub_folder_id"
            label="{{trans('crud.extoutboxes.inputs.sub_folder_id')}}"
            wire:model="selectedSubFolderId">
            <option selected>الرجاء اختيار المجلد الفرعي</option>
            @foreach($allSubFolders as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select> </x-inputs.group
    >@endif
</div>
