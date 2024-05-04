@extends('layouts.app', ['page' => 'activities'])
@section('content')
<div class="card">
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <form>
                <div class="row g-2">
                    <div class="input-icon col">
                        <span class="input-icon-addon">
                            <i class="ti ti-search"></i>
                        </span>
                        <input
                            id="indexSearch"
                            name="search"
                            type="text"
                            value=""
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
            <div class="col-auto ms-auto d-print-none">                
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
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
                    <th class="text-center">@lang('crud.common.actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $k=> $activity)
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
    <div class="card-footer d-flex align-items-left">
        {!! $activities->render() !!}
    </div>
</div>
@endsection
