@extends('layouts.app', ['page' => 'intoutboxes'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('intoutboxes.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.intoutboxes.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.number')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.registered_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->registered_at->format('Y-d-m')?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.issued_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->issued_at->format('Y-d-m') ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.sender')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->sender ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.receiver')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->receiver ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.subject')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->subject ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.company_status')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $intoutbox->company_status ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.intoutboxes.inputs.sub_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($intoutbox->subFolder)->name ?? '-' }}"
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
                href="{{ route('intoutboxes.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\Intoutbox::class)
            <a href="{{ route('intoutboxes.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection
