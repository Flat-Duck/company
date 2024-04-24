@props([
    'required' => false
])

<label class="form-label {{ $required ? 'required' : '' }}">
    {{ $label }}
</label>