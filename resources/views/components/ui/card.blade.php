@props(['padding' => true])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-line bg-surface shadow-card '.($padding ? 'p-5 sm:p-6' : '')]) }}>
    {{ $slot }}
</div>
