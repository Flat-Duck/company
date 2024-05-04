@extends('layouts.app', ['page' => 'reports'])

@section('title', trans('تقرير فواتير') )
@section('content')
<div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">@lang('تقرير فواتير') {{ $type }}</h2>
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
                            <th>@lang('crud.invoices.inputs.number')</th>
                            <th>@lang('crud.invoices.inputs.date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $k=> $invoice)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $invoice->number ?? '-' }}</td>
                            <td>{{ $invoice->created_at->format('Y/m/d') ?? '-' }}</td>   
                            
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
            @if( $invoices->hasPages() )
            <div class="card-footer pb-0">{{ $invoices->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
