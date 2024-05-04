@extends('layouts.app', ['page' => 'reports'])

@section('title', trans('الجرد') )
@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">@lang('الجرد') {{ $type }}</h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="table-responsive">
                <table
                    class="table"
                    id="dataTable"
                    width="100%"
                    cellspacing="0"
                >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('crud.items.inputs.name')</th>
                            <th>@lang('crud.items.inputs.type')</th>
                            <th>@lang('crud.items.inputs.quantity')</th>
                            <th>@lang('crud.items.inputs.ex_date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $k=> $item)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>{{ $item->type ?? '-' }}</td>
                            <td>{{ $item->quantity ?? '-' }}</td>
                            <td>{{ $item->ex_date->format('Y/m/d') ?? '-' }}</td>                            
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
