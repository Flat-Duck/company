<div class="w-100 p-0">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="main_folder_id"
            label="Main Folder"
            wire:model="selectedMainFolderId"
        >
            <option selected>Please select the Main Folder</option>
            @foreach($allMainFolders as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    @if(!empty($selectedMainFolderId))
    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="sub_folder_id"
            label="Sub Folder"
            wire:model="selectedSubFolderId"
        >
            <option selected>Please select the Sub Folder</option>
            @foreach($allSubFolders as $id => $name)
            <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </x-inputs.select> </x-inputs.group
    >@endif
</div>
