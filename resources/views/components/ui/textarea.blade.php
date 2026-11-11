@props([
    'name',
    'label',
    'value' => null,
    'rows' => 4,
    'required' => false,
    'placeholder' => '',
    'hint' => null,
])

@php
    $id = $attributes->get('id', $name);
    $hasError = $errors->has($name);
    $describedBy = collect([
        $hint ? $id.'-hint' : null,
        $hasError ? $id.'-error' : null,
    ])->filter()->implode(' ');

    $inputClasses = 'w-full rounded-xl border bg-surface px-3.5 py-2.5 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100 '
        .($hasError ? 'border-danger-500 ring-2 ring-danger-100' : 'border-field');
@endphp

<div>
    <label for="{{ $id }}" class="mb-1.5 block text-sm font-medium text-ink">
        {{ $label }}@if ($required)<span class="ml-0.5 text-danger-600" aria-hidden="true">*</span>@endif
    </label>

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if ($required) required @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
        @if ($hasError) aria-invalid="true" @endif
        {{ $attributes->merge(['class' => $inputClasses]) }}
    >{{ old($name, $value) }}</textarea>

    @if ($hint)
        <p id="{{ $id }}-hint" class="mt-1.5 text-xs text-muted">{{ $hint }}</p>
    @endif

    @error($name)
        <p id="{{ $id }}-error" role="alert" class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
    @enderror
</div>
