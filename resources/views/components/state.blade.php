{{-- @props([
    'title',
    'subtitle',
    'color'
])

<div class="col-md-6 col-xl-3">
    <div class="card card-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-auto">
                    <span class="{{ $color }} text-white avatar">
                        <i class="ti ti-chart-bar"></i>
                    </span>
                </div>
                <div class="col">
                    <div class="font-weight-medium">
                        {{$title}}
                    </div>
                    <div class="text-secondary">
                        {{$subtitle}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@props([
    'title',
    'subtitle',
    'color',
    'icon' => 'chart-bar',
    'link' => '#'
])

<div class="col-md-6 col-xl-3 col-sm-6 col-lg-3 mb-3">
    <a href="{{ $link }}" class="page-link">
        <div class="card card-sm p-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="{{ $color }} text-white avatar">
                            <i class="ti ti-{{$icon}}"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{$title}}
                        </div>
                        <div class="text-secondary">
                            {{$subtitle}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>