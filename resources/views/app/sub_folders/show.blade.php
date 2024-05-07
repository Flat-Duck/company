@extends('layouts.app', ['page' => 'sub-folders'])
@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('sub-folders.index') }}" class="mr-4"
            ><i class="ti ti-arrow-back"></i
        ></a>
        <h3 class="card-title">@lang('crud.sub_folders.show_title')</h3>
    </div>

    <div class="card-body">
        <div class="row g-5">
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.sub_folders.inputs.name')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ $subFolder->name ?? '-' }}"
                                disabled=""
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"
                                >@lang('crud.sub_folders.inputs.main_folder_id')</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                value="{{ optional($subFolder->mainFolder)->name ?? '-' }}"
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
                href="{{ route('sub-folders.index') }}"
                class="btn btn-outline-secondary"
                >@lang('crud.common.back')</a
            >

            @can('create', App\Models\SubFolder::class)
            <a href="{{ route('sub-folders.create') }}" class="btn btn-primary">
                @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </div>
</div>
<br />

<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-left">الصادر الداخلي</h3>
            </div>
            <div class="card-header">
                <form>
                    <div class="row g-2">
                        <div class="input-icon col">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input
                                id="indexSearch"
                                name="int_search"
                                type="text"
                                value="{{$int_search}}"
                                class="form-control"
                                placeholder="بحث ...."
                                aria-label="Search..."
                                spellcheck="false"
                                data-ms-editor="true"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-auto">
                            <button
                                class="btn btn-icon btn-primary"
                                aria-label="Button"
                            >
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left"> @lang('crud.memos.inputs.number') </th>
                                <th class="text-left">@lang('crud.common.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($intouts as  $k=> $intout)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $intouts->number ?? '-' }}</td>
                                <td class="text-left">
                                    @can('view', $intout)
                                        <a href="{{ route('sub-folders.show', $intout) }}" class="btn btn-icon btn-outline-info ms-1" >
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">@lang('crud.common.no_items_found')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-left">
                    {!! $intouts->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-left">الصادر الخارجي</h3>
            </div>
            <div class="card-header">
                <form>
                    <div class="row g-2">
                        <div class="input-icon col">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input
                                id="indexSearch"
                                name="ext_search"
                                type="text"
                                value="{{$ext_search}}"
                                class="form-control"
                                placeholder="بحث ...."
                                aria-label="Search..."
                                spellcheck="false"
                                data-ms-editor="true"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-auto">
                            <button
                                class="btn btn-icon btn-primary"
                                aria-label="Button"
                            >
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left"> @lang('crud.memos.inputs.number') </th>
                                <th class="text-left">@lang('crud.common.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($extouts as  $k=> $extout)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $extout->number ?? '-' }}</td>
                                <td class="text-left">
                                    @can('view', $extout)
                                        <a href="{{ route('sub-folders.show', $extout) }}" class="btn btn-icon btn-outline-info ms-1" >
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">@lang('crud.common.no_items_found')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-left">
                    {!! $extouts->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-left">الوارد</h3>
            </div>
            <div class="card-header">
                <form>
                    <div class="row g-2">
                        <div class="input-icon col">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input
                                id="indexSearch"
                                name="inb_search"
                                type="text"
                                value="{{$inb_search}}"
                                class="form-control"
                                placeholder="بحث ...."
                                aria-label="Search..."
                                spellcheck="false"
                                data-ms-editor="true"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-auto">
                            <button
                                class="btn btn-icon btn-primary"
                                aria-label="Button"
                            >
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left"> @lang('crud.memos.inputs.number') </th>
                                <th class="text-left">@lang('crud.common.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inboxes as  $k=> $inbox)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $inbox->number ?? '-' }}</td>
                                <td class="text-left">
                                    @can('view', $inbox)
                                        <a href="{{ route('sub-folders.show', $inbox) }}" class="btn btn-icon btn-outline-info ms-1" >
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">@lang('crud.common.no_items_found')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-left">
                    {!! $inboxes->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                <h3 class="text-left">معاملات أخرى</h3>
            </div>
            <div class="card-header">
                <form>
                    <div class="row g-2">
                        <div class="input-icon col">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                            <input
                                id="indexSearch"
                                name="mem_search"
                                type="text"
                                value="{{$mem_search}}"
                                class="form-control"
                                placeholder="بحث ...."
                                aria-label="Search..."
                                spellcheck="false"
                                data-ms-editor="true"
                                autocomplete="off"
                            />
                        </div>
                        <div class="col-auto">
                            <button
                                class="btn btn-icon btn-primary"
                                aria-label="Button"
                            >
                                <i class="ti ti-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-left">#</th>
                                <th class="text-left">@lang('crud.memos.inputs.number') </th>
                                <th class="text-left">@lang('crud.common.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($memos as  $k=> $memo)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $memo->number ?? '-' }}</td>
                                <td class="text-left">
                                    @can('view', $memo)
                                        <a href="{{ route('memos.show', $memo) }}" class="btn btn-icon btn-outline-info ms-1" >
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">@lang('crud.common.no_items_found')</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-left">
                    {!! $memos->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
