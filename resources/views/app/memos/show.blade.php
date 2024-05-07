@extends('layouts.app', ['page' => 'memos'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('memos.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.memos.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.memos.inputs.number')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $memo->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.memos.inputs.registered_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $memo->registered_at->format('Y-d-m')?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.memos.inputs.issued_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $memo->issued_at->format('Y-d-m') ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.memos.inputs.type')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $memo->type ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.memos.inputs.subject')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $memo->subject ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.memos.inputs.sub_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($memo->subFolder)->name ?? '-' }}"
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
                href="{{ route('memos.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\Memo::class)
            <a href="{{ route('memos.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection
