@extends('layouts.app', ['page' => 'attachments'])

@section('content')
<form
    method="POST"
    action="{{ route('attachments.update', $attachment) }}"
    has-files
    class="card"
>
    @csrf @method('PUT')
    <div class="card-header">
        <a href="{{ route('attachments.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.attachments.edit_title')</h3>
    </div>
    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        @include('app.attachments.form-inputs')
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
            <a href="{{ route('attachments.create') }}" class="btn btn-link">
                @lang('crud.common.create')
            </a>
            @endcan
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> @lang('crud.common.update')
            </button>
        </div>
    </div>
</form>

@endsection
