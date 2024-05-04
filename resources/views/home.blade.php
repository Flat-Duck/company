@extends('layouts.app', ['page' => 'dashboard'])
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center d-print-none">
        <x-state color="bg-yellow" title="عدد الطلبيات بحاجة الي صرف" subtitle="{{ \App\Models\Order::NotIssuedCount() }}" />
        <x-state color="bg-green" title="عدد أذونات صرف" subtitle="{{ \App\Models\Issue::count() }}" />
        <x-state color="bg-blue" title="عدد الاصناف الموجودة" subtitle="{{ \App\Models\Item::count() }}" />
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card card-sm">
                <div class="card-status-top bg-red"></div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="row g-2">
                            <div class="col">
                                <h3 class="card-title">الاصناف ذات صلاحية شارفت على الانتهاء [{{ \App\Models\Item::expiring()->count()}}]</h3>
                            </div>                            
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <a class="btn btn-info col-auto" href="{{route('printer')}}">طباعة</a>
                        </div>
                    </div>
                
                
                <div class="divide-y-2 mt-4">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('crud.items.inputs.name')</th>
                                    <th>@lang('crud.items.inputs.quantity')</th>
                                    <th>@lang('crud.items.inputs.ex_date')</th>
                                    <th>عرض</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\App\Models\Item::expiring() as $k => $item )
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $item->name ?? '-' }}</td>
                                    <td>{{ $item->quantity ?? '-' }}</td>
                                    <td>{{ $item->ex_date->format('Y/m/d') ?? '-' }}</td>
                                    <td>
                                        <div role="group" aria-label="Row Actions" class="d-flex" >
                                            @can('view', $item)
                                            <a href="{{ route('items.show', $item) }}" class=" btn btn-icon btn-outline-warning ms-1">
                                                <i class="ti ti-eye"></i>                                                
                                            </a>
                                            @endcan                   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
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
          </div>
          <div class="col-md-6">
            <div class="card card-sm">
                <div class="card-status-top bg-red"></div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="row g-2">
                            <div class="col">
                                <h3 class="card-title">الاصناف ذات كمية شارفت على الانتهاء [{{ \App\Models\Item::low_stock()->count()}}]</h3>
                            </div>                            
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <a class="btn btn-info col-auto" href="{{route('printer')}}">طباعة</a>
                        </div>
                    </div>
                
                
                <div class="divide-y-2 mt-4">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('crud.items.inputs.name')</th>
                                    <th>@lang('crud.items.inputs.quantity')</th>
                                    <th>@lang('crud.items.inputs.ex_date')</th>
                                    <th>عرض</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\App\Models\Item::low_stock() as $k => $item )
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td>{{ $item->name ?? '-' }}</td>
                                    <td>{{ $item->quantity ?? '-' }}</td>
                                    <td>{{ $item->ex_date->format('Y/m/d') ?? '-' }}</td>
                                    <td>
                                        <div role="group" aria-label="Row Actions" class="d-flex" >
                                            @can('view', $item)
                                            <a href="{{ route('items.show', $item) }}" class=" btn btn-icon btn-outline-warning ms-1">
                                                <i class="ti ti-eye"></i>                                                
                                            </a>
                                            @endcan                   
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">
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
          </div>
    </div>
</div> --}}
@endsection
