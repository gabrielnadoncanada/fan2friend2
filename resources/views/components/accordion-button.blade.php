@props(['index', 'title' => 'Accordion title'])

<button type="button" x-description="Expand/collapse question button"
        class="flex w-full items-start justify-between text-left text-gray-900"
        aria-controls="faq-0"
        @click="activeAccordion = (activeAccordion === {{ $index }}) ? null : {{ $index }}"
        aria-expanded="true"
        x-bind:aria-expanded="open.toString()">
    <span class="text-base font-semibold leading-7">{!! $title !!}</span>
    <span class="ml-6 flex h-7 items-center">
        <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
             x-state:off="Item collapsed" class="h-6 w-6 hidden" :class="{ 'hidden': activeAccordion === {{ $index }} }" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
     <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
          x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': !(activeAccordion === {{ $index }}) }" fill="none"
          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
    </span>
</button>
