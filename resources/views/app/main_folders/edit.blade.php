@extends('layouts.app', ['page' => 'main-folders'])

@section('content')
<form
    method="POST"
    action="{{ route('main-folders.update', $mainFolder) }}"
    class="card"
>
    @csrf @method('PUT')
    <div class="card-header">
        <a href="{{ route('main-folders.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.main_folders.edit_title')</h3>
    </div>
    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        @include('app.main_folders.form-inputs')
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
            <a href="{{ route('main-folders.create') }}" class="btn btn-info">
                @lang('crud.common.create')
            </a>
            @endcan
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> @lang('crud.common.update')
            </button>
        </div>
    </div>
</form>
@can('view-any', App\Models\SubFolder::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">المجلدات الفرعية</h3>
    </div>
    <div class="card-body">
        <livewire:main-folder-sub-folders-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan
{{-- @can('view-any', App\Models\Inbox::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Inboxes</h3>
    </div>
    <div class="card-body">
        <livewire:main-folder-inboxes-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Memo::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Memos</h3>
    </div>
    <div class="card-body">
        <livewire:main-folder-memos-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Intoutbox::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Intoutboxes</h3>
    </div>
    <div class="card-body">
        <livewire:main-folder-intoutboxes-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan @can('view-any', App\Models\Extoutbox::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Extoutboxes</h3>
    </div>
    <div class="card-body">
        <livewire:main-folder-extoutboxes-detail :mainFolder="$mainFolder" />
    </div>
</div>
@endcan --}}
 @endsection
