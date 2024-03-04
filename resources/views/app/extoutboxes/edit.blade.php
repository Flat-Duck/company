@extends('layouts.app', ['page' => 'extoutboxes'])

@section('content')
<form
    method="POST"
    action="{{ route('extoutboxes.update', $extoutbox) }}"
    class="card"
>
    @csrf @method('PUT')
    <div class="card-header">
        <a href="{{ route('extoutboxes.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.extoutboxes.edit_title')</h3>
    </div>
    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        @include('app.extoutboxes.form-inputs')
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
            <a href="{{ route('extoutboxes.create') }}" class="btn btn-link">
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
