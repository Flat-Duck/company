@extends('layouts.app', ['page' => 'inboxes'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('inboxes.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.inboxes.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.number')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.registered_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->registered_at ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.issued_at')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->issued_at ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.sender')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->sender ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.receiver')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->receiver ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.subject')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->subject ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.type')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->type ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.company_status')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $inbox->company_status ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.main_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($inbox->mainFolder)->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.sub_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($inbox->subFolder)->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.main_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($inbox->mainFolder)->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.inboxes.inputs.sub_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($inbox->subFolder)->name ?? '-' }}"
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
                href="{{ route('inboxes.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\Inbox::class)
            <a href="{{ route('inboxes.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection
