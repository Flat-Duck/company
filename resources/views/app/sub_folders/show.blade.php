@extends('layouts.app', ['page' => 'sub-folders'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('sub-folders.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.sub_folders.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.sub_folders.inputs.name')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $subFolder->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.sub_folders.inputs.main_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($subFolder->mainFolder)->name ?? '-' }}"
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
                href="{{ route('sub-folders.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\SubFolder::class)
            <a href="{{ route('sub-folders.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection
