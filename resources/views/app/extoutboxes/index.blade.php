@extends('layouts.app', ['page' => 'extoutboxes'])
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
                @can('create', App\Models\Extoutbox::class)
                <a
                    data-bs-original-title="إنشاء"
                    data-bs-placement="top"
                    data-bs-toggle="tooltip"
                    class="pull-right btn btn-primary"
                    href="{{ route('extoutboxes.create') }}"
                >
                    <i class="ti ti-plus"></i>
                    @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.number')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.registered_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.issued_at')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.sender')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.receiver')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.subject')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.company_status')
                    </th>
                    <th class="text-left">
                        @lang('crud.extoutboxes.inputs.sub_folder_id')
                    </th>

                    <th class="text-center">@lang('crud.common.actions')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($extoutboxes as $extoutbox)
                <tr>
                    <td>{{ $extoutbox->number ?? '-' }}</td>
                    <td>{{ $extoutbox->registered_at->format('Y-d-m')?? '-' }}</td>
                    <td>{{ $extoutbox->issued_at->format('Y-d-m') ?? '-' }}</td>
                    <td>{{ $extoutbox->sender ?? '-' }}</td>
                    <td>{{ $extoutbox->receiver ?? '-' }}</td>
                    <td>{{ $extoutbox->subject ?? '-' }}</td>
                    <td>{{ $extoutbox->company_status ?? '-' }}</td>
                    <td>{{ optional($extoutbox->subFolder)->name ?? '-' }}</td>
                    <td class="text-center" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="btn-group"
                        >
                            @can('update', $extoutbox)
                            <a
                                href="{{ route('extoutboxes.edit', $extoutbox) }}"
                                class="btn btn-icon btn-outline-warinig ms-1"
                            >
                                <i class="ti ti-edit"></i>
                            </a>
                            @endcan @can('view', $extoutbox)
                            <a
                                href="{{ route('extoutboxes.show', $extoutbox) }}"
                                class="btn btn-icon btn-outline-info ms-1"
                            >
                                <i class="ti ti-eye"></i>
                            </a>
                            @endcan 
                            {{-- @can('delete', $extoutbox)
                            <form
                                action="{{ route('extoutboxes.destroy', $extoutbox) }}"
                                method="POST"
                                class="inline pointer ms-1"
                                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                            >
                                @csrf @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-icon btn-outline-danger"
                                >
                                    <i class="ti ti-trash-x"></i>
                                </button>
                            </form>
                            @endcan --}}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12">@lang('crud.common.no_items_found')</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex align-items-left">
        {!! $extoutboxes->render() !!}
    </div>
</div>
@endsection
