@extends('layouts.app', ['page' => 'dashboard'])
@section('content')
<div class="container">
    <div class="row justify-content-center d-print-none">
        <x-state color="bg-cyan-lt" icon="external-link-off" title="الصادر الداخلي" subtitle="{{ \App\Models\Extoutbox::count() }}" />
        <x-state color="bg-azure-lt" icon="external-link" title="الصادر الخارجي" subtitle="{{ \App\Models\Intoutbox::count() }}" />
        <x-state color="bg-indigo-lt" icon="inbox" title="رسائل الوارد" subtitle="{{ \App\Models\Inbox::count() }}" />
        <x-state color="bg-blue-lt" icon="clipboard-typography" title="المعاملات الاخرى " subtitle="{{ \App\Models\Memo::count() }}" />
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card card-sm">
                <div class="card-status-top bg-yellow"></div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="row g-2">
                            <div class="col">
                                <h3 class="card-title">سجل حركة المستخدمين</h3>
                            </div>
                        </div>
                    </div>
                    <div class="divide-y-2 mt-4">
                        <div class="table-responsive">
                            <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-left">
                                            #
                                        </th>
                                        <th class="text-left">
                                            المعاملة
                                        </th>
                                        <th class="text-left">
                                            نوع العملية
                                        </th>
                                        <th class="text-left">
                                            القائم بالعملية
                                        </th>
                                        <th class="text-left">
                                            وصف العملية
                                        </th>
                                        <th class="text-center">
                                            عرض
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\Activity::all()  as $k=> $activity)
                                        <tr>
                                            <td>{{ $k+1 }}</td>
                                            <td>{{ $activity->name ?? '-' }}</td>
                                            <td>{{ $activity->type ?? '-' }}</td>
                                            <td>{{ $activity->user->name ?? '-' }}</td>
                                            <td>{{ $activity->description ?? '-' }}</td>
                                            <td class="text-center" style="width: 134px;">
                                                <div role="group" aria-label="Row Actions" class="btn-group">
                                                    <a href="{{$activity->link}}" class="btn btn-icon btn-outline-info ms-1" >
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">@lang('crud.common.no_items_found')</td>
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
    </div>
</div>
@endsection
