@extends('layouts.app', ['page' => 'extoutboxes'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('extoutboxes.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.extoutboxes.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.number')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.registered_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->registered_at->format('Y-d-m')?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.issued_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->issued_at->format('Y-d-m') ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.sender')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->sender ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.receiver')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->receiver ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.subject')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->subject ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.company_status')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $extoutbox->company_status ?? '-' }}"
                                disabled=""
                            />
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.extoutboxes.inputs.sub_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($extoutbox->subFolder)->name ?? '-' }}"
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
                href="{{ route('extoutboxes.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\Extoutbox::class)
            <a href="{{ route('extoutboxes.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection
