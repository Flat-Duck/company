@extends('layouts.app', ['page' => 'reports'])

@section('title', trans('الجرد') )
@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">{{ $type }}</h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <a href="#" onclick="window.print()" class="mr-4 btn btn-info d-print-none">
                    <i class="ti ti-printer"></i> طباعة
                </a>
                <div class="d-flex text-center m-auto">
                    <h3 class="card-title ">
                        {{ $type }}
                    </h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('crud.inboxes.inputs.number')</th>
                            <th>@lang('crud.inboxes.inputs.registered_at')</th>
                            <th>@lang('crud.inboxes.inputs.issued_at')</th>
                            <th>@lang('crud.inboxes.inputs.sender')</th>
                            <th>@lang('crud.inboxes.inputs.receiver')</th>
                            <th>@lang('crud.inboxes.inputs.subject')</th>
                            <th>@lang('crud.inboxes.inputs.type')</th>
                            <th>@lang('crud.inboxes.inputs.company_status')</th>
                            <th>@lang('crud.inboxes.inputs.main_folder_id')</th>
                            <th>@lang('crud.inboxes.inputs.sub_folder_id')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $k=> $item)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $item->number ?? '-' }}</td>
                            <td>{{ $item->registered_at->format('Y/m/d') ?? '-' }}</td>
                            <td>{{ $item->issued_at->format('Y/m/d') ?? '-' }}</td>
                            <td>{{ $item->sender ?? '-' }}</td>
                            <td>{{ $item->receiver ?? '-' }}</td>
                            <td>{{ $item->subject ?? '-' }}</td>
                            <td>{{ $item->type ?? '-' }}</td>
                            <td>{{ $item->company_status ?? '-' }}</td>
                            <td>{{ optional($item->subFolder->mainFolder)->name ?? '-' }}</td>
                            <td>{{ optional($item->subFolder)->name ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
