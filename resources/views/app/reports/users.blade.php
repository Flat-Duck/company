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
                            <th>@lang('crud.users.inputs.name')</th>
                            <th>الجنس</th>
                            <th>رقم الهاتف</th>
                            <th>@lang('crud.users.inputs.email')</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $k=> $item)
                        <tr>
                            <td>{{ $k+1 }}</td>
                            <td>{{ $item->name ?? '-' }}</td>
                            <td>{{ $item->gender ?? '-' }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                            <td>{{ $item->email ?? '-' }}</td>
                            <td>
                                @if ($item->active)
                                <span class="badge bg-lime text-lime-fg">مفعل</span>
                                @else
                                <span class="badge bg-red text-red-fg">غير مفعل</span>                        
                                @endif
                            </td>
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
