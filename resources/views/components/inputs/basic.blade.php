@props([
    'name',
    'label',
    'value',
    'type' => 'text',
    'min' => null,
    'max' => null,
    'step' => null,
    'required' => false
])

@if($label ?? null)
    @include('components.inputs.partials.label',['required' => $required])
@endif

<input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value ?? '') }}" {{ ($required ?? false) ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'form-control']) }}
    {{ $min ? "min={$min}" : '' }}
    {{ $max ? "max={$max}" : '' }}
    {{ $step ? "step={$step}" : '' }}
    @error($name)
        {{ $attributes->merge(['class' => 'is-invalid']) }}
    @enderror
    autocomplete="off" >

@error($name)
    @include('components.inputs.partials.error')
@enderror