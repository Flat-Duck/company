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
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>المعاملة</th>
                            <th>نوع العملية</th>
                            <th>القائم بالعملية</th>
                            <th>وصف العملية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $k=> $item)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>{{ $item->type ?? '-' }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td>{{ $item->description ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">
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
