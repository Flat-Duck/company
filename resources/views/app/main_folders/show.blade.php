@extends('layouts.app', ['page' => 'main-folders'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('main-folders.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.main_folders.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.main_folders.inputs.name')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $mainFolder->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a
                href="{{ route('main-folders.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\MainFolder::class)
            <a
                href="{{ route('main-folders.create') }}"
                class="btn btn-primary"
            >
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>
<br />
<div class="card">
    <div class="card-header">
        <h3 class="text-left"> المجلدات الفرعية </h3>
    </div>
    <div class="card-body">
        <div class="row">
        <div class="table-responsive m-1">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th class="text-left"> @lang('crud.sub_folders.inputs.name') </th>
                    <th class="text-left"> @lang('crud.sub_folders.inputs.main_folder_id') </th>
                    <th class="text-center">@lang('crud.common.actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subFolders as $subFolder)
                <tr>
                    <td>{{ $subFolder->name ?? '-' }}</td>
                    <td>{{ optional($subFolder->mainFolder)->name ?? '-' }}</td>
                    <td class="text-center" style="width: 134px;">
                        <div role="group" aria-label="Row Actions"class="btn-group" >
                            @can('view', $subFolder)
                            <a href="{{ route('sub-folders.show', $subFolder) }}"
                            class="btn btn-icon btn-outline-info ms-1" >
                            <i class="ti ti-eye"></i>
                        </a>
                        @endcan                         
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">@lang('crud.common.no_items_found')</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="card-footer d-flex align-items-left">
    {!! $subFolders->render() !!}
</div>
</div>
</div>
</div>

{{-- @can('view-any', App\Models\SubFolder::class)
<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title w-100 mb-2">Sub Folders</h4>

        <livewire:main-folder-sub-folders-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Inbox::class)
<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title w-100 mb-2">Inboxes</h4>

        <livewire:main-folder-inboxes-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan  --}}

@endsection
