@extends('layouts.app', ['page' => 'reports'])

@section('title', trans('تقرير') )
@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">@lang('تقرير') {{ $type }}</h2>
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
                            <th>@lang('crud.orders.inputs.number')</th>
                            <th>@lang('crud.orders.inputs.status')</th>
                            <th>@lang('تاريخ الطلب')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $k=> $order)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $order->number ?? '-' }}</td>
                            <td>{{ $order->status ?? '-' }}</td>
                            <td>{{ $order->created_at->format('Y/m/d') ?? '-' }}</td>   
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if( $orders->hasPages() )
            <div class="card-footer pb-0">{{ $orders->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
