@props(['activeAccordion' => -1])

<div x-data="{ activeAccordion: {{ $activeAccordion }} }" {{ $attributes }}>
    {{ $slot }}
</div>
