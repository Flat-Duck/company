@props([
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
</div>