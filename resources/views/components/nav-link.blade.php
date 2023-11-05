<li {{ $attributes->merge(['class' => $theme()]) }}>
    @if (isset($link))
        <a class="flex items-center" href="{{ $link }}">
            {{ $slot }}
            <span class="absolute inset-0"></span>
        </a>
    @else
        {{ $slot }}
    @endif

</li>
