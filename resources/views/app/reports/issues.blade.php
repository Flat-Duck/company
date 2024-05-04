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
                            <th>@lang('crud.issues.inputs.number')</th>
                            {{-- <th>@lang('المكتب / القسم')</th> --}}
                            <th>@lang('تاريخ الصرف')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($issues as $k=> $issue)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $issue->number ?? '-' }}</td>
                            {{-- <td>{{ $issue->order->office->name ?? '-' }}</td> --}}
                            <td>{{ $issue->created_at->format('Y/m/d') ?? '-' }}</td>   
                            
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
            @if( $issues->hasPages() )
            <div class="card-footer pb-0">{{ $issues->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
