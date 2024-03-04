@extends('layouts.app', ['page' => 'attachments'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('attachments.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.attachments.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.attachments.inputs.name')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $attachment->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.attachments.inputs.file')</label
                            >
                            @if($attachment->file)
                            <a
                                href="{{ \Storage::url($attachment->file) }}"
                                target="blank"
                                ><i class="ti ti-cloud-download"></i
                                >&nbsp;Download</a
                            >
                            @else - @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.attachments.inputs.extoutbox_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($attachment->extoutbox)->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.attachments.inputs.intoutbox_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($attachment->intoutbox)->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.attachments.inputs.inbox_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($attachment->inbox)->number ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.attachments.inputs.memo_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($attachment->memo)->number ?? '-' }}"
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
                href="{{ route('attachments.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\Attachment::class)
            <a href="{{ route('attachments.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>

@endsection
