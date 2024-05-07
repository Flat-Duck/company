@extends('layouts.app', ['page' => 'memos'])

@section('content')
<form method="POST" action="{{ route('memos.update', $memo) }}" class="card">
    @csrf @method('PUT')
    <div class="card-header">
        <a href="{{ route('memos.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.memos.edit_title')</h3>
    </div>
    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        @include('app.memos.form-inputs')
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
            <a href="{{ route('memos.create') }}" class="btn btn-info">
                @lang('crud.common.create')
            </a>
            @endcan
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> @lang('crud.common.update')
            </button>
        </div>
    </div>
</form>

@can('view-any', App\Models\Attachment::class)
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">المرفقات</h3>
    </div>
    <div class="card-body">
        <livewire:memo-attachments-detail :memo="$memo" />
    </div>
</div>
@endcan @endsection
