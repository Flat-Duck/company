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

@can('view-any', App\Models\SubFolder::class)
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
@endcan @endsection
