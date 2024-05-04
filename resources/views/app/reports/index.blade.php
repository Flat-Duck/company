@extends('layouts.app', ['page' => 'reports'])

@section('title',  trans('crud.orders.create_title') )
@section('content')
{{-- <div class="container-xl">
    <div class="page-header d-print-none">
        <h2 class="page-title">إنشاء تقرير</h2>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            إنشاء تقرير
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-xl-12">
                                <form role="form" method="GET" action="{{ route('reports.inventory') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <x-inputs.select name="type" label="تقرير الجرد" required>
                                                <option disabled >الرجاء اختيار نوع الجرد</option>
                                                <option value="يومي" >يومي</option>
                                                <option value="شهري" >شهري</option>
                                                <option value="سنوي" >سنوي</option>                                                
                                            </x-inputs.select>
                                        </x-inputs.group>
                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create')
                                            </button>                                    
                                        </x-inputs.group>                  
                                    </div>
                                </form>
                                <form role="form" method="GET" action="{{ route('reports.invoices') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <x-inputs.select name="type" label="تقرير الفواتير" required>
                                                <option disabled >الرجاء اختيار نوع الفاتورة</option>
                                                <option value="وارد" >وارد</option>
                                                <option value="تالف" >تالف</option>
                                            </x-inputs.select>
                                        </x-inputs.group>
                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create')
                                            </button>                                    
                                        </x-inputs.group>                  
                                    </div>
                                </form>
                                
                                <form role="form" method="GET" action="{{ route('reports.orders') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <x-inputs.select name="office_id" label="تقرير متطلبات القسم" required>
                                                <option disabled  selected>الرجاء اختيار المكتب</option>
                                                <option value="0">الكل</option>
                                                @foreach($offices as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </x-inputs.select>
                                        </x-inputs.group>

                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create')
                                            </button>                                    
                                        </x-inputs.group>                  
                                    </div>
                                </form>
                                <form role="form" method="GET" action="{{ route('reports.issues') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <label class="form-label">
                                                
                                            </label>
                                        </x-inputs.group>

                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create') تقرير اذونات الصرف
                                            </button>                                    
                                        </x-inputs.group>                  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
