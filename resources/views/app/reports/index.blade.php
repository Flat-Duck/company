@extends('layouts.app', ['page' => 'reports'])

@section('title',  trans('crud.orders.create_title') )
@section('content')
<div class="container-xl">
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
                                <form role="form" method="GET" action="{{ route('reports.messages') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <x-inputs.select name="type" label="تقرير الرسائل">
                                                <option disabled >الرجاء اختيار نوع الرسائل</option>
                                                <option value="inbox" >وارد</option>
                                                <option value="extoutboxes" >الصادر الخارجي</option>
                                                <option value="intoutboxes" >الصادر الداخلي</option>
                                                <option value="memos" >معاملات أخرى</option>
                                                <option value="outboxes" >الصادر الخارجي والداخلي</option>
                                            </x-inputs.select>
                                        </x-inputs.group>
                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create')
                                            </button>
                                        </x-inputs.group>
                                    </div>
                                </form>
                                <form role="form" method="GET" action="{{ route('reports.sub_folders') }}" >
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <x-inputs.select name="mainid" label="تقرير المجلدات الفرعية " required>
                                                <option value="0" >كل المجلدات الفرعية</option>
                                                <option disabled >أو اختار مجلد رئيسي لعرض المجلدات الفرعية</option>
                                                @foreach ($mains as $main)
                                                    <option value="{{$main->id}}" >{{$main->name}}</option>
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
                                {{-- 
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
                                --}}
                                <form role="form" method="GET" action="{{ route('reports.main_folders') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <label class="form-label">
                                                عرض تقرير بجميع المجلدات الرئيسية
                                            </label>
                                        </x-inputs.group>
                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create') تقرير المجلدات الرئيسية
                                            </button>
                                        </x-inputs.group>
                                    </div>
                                </form>
                                <form role="form" method="GET" action="{{ route('reports.users') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <label class="form-label">
                                                عرض تقرير بجميع مستخدمي النظام
                                            </label>
                                        </x-inputs.group>
                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create') تقرير المستخدمين
                                            </button>
                                        </x-inputs.group>
                                    </div>
                                </form>
                                <form role="form" method="GET" action="{{ route('reports.activity') }}" > 
                                    @csrf
                                    <div class="row">
                                        <x-inputs.group class="col-sm-6">
                                            <label class="form-label">
                                                عرض تقرير بجميع نشاطات المستخدمين
                                            </label>
                                        </x-inputs.group>
                                        <x-inputs.group class="col-sm-6 mt-5">
                                            <button type="submit" class="btn btn-primary">
                                                @lang('crud.common.create') تقرير نشاطات المستخدمين
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
</div>
@endsection
