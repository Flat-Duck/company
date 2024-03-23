@extends('layouts.app', ['page' => 'sub-folders'])

@section('content')
<form
    method="POST"
    action="{{ route('sub-folders.update', $subFolder) }}"
    class="card"
>
    @csrf @method('PUT')
    <div class="card-header">
        <a href="{{ route('sub-folders.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.sub_folders.edit_title')</h3>
    </div>
    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        @include('app.sub_folders.form-inputs')
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
            <a href="{{ route('sub-folders.create') }}" class="btn btn-info">
                @lang('crud.common.create')
            </a>
            @endcan
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> @lang('crud.common.update')
            </button>
        </div>
    </div>
</form>

@can('view-any', App\Models\Inbox::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Inboxes</h3>
    </div>
    <div class="card-body">
        <livewire:sub-folder-inboxes-detail :subFolder="$subFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Memo::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Memos</h3>
    </div>
    <div class="card-body">
        <livewire:sub-folder-memos-detail :subFolder="$subFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Intoutbox::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Intoutboxes</h3>
    </div>
    <div class="card-body">
        <livewire:sub-folder-intoutboxes-detail :subFolder="$subFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Extoutbox::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Extoutboxes</h3>
    </div>
    <div class="card-body">
        <livewire:sub-folder-extoutboxes-detail :subFolder="$subFolder" />
    </div>
</div>
@endcan @endsection
