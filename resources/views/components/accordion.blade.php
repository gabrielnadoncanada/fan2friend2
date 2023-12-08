@props(['index', 'title' => 'Accordion title'])

<div {{ $attributes->merge(['class' => $theme()]) }}>
    <dt>
        <x-accordion-button :index="$index" :title="$title"/>
    </dt>
    <dd class="mt-4 pr-12 text-base leading-7 text-gray-600" id="accordion-{{$index}}" x-show="activeAccordion === {{ $index }}">
        {{ $slot }}
    </dd>
</div>
