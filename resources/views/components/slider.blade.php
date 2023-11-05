@props([
    'desktop' => 1,
    'tablet' => 1,
    'mobile' => 1,
    'autoplay' => 'false',
    'autoplayDelay' => 2000,
    'autoplayDirection' => 'false',
    'speed' => 400,
    'loop' => 'false',
    'pauseOnHover' => 'true',
    'keyboard' => 'false',
    'mousewheel' => 'false',
    'autoHeight' => 'false',
    'deskSpace' => 30,
    'tabSpace' => 20,
    'phoneSpace' => 10,
    'id' => 'membres',
    'pagination' => 'true',
    'navigation' => 'true',
    'nextEl' => 'false',
    'prevEl' => 'false',
    'width' => 'false',
    'direction' => 'horizontal',
])


<div {{ $attributes->merge(['class' => 'slider slider-active-pagination relative']) }}>
    {{ $slot }}
    {{-- <div class="slider-container swiper h-full" data-nextel="{{ $nextEl }}" data-prevel="{{ $prevEl }}"
         data-desktop="{{ $desktop }}" data-tablet="{{ $tablet }}" data-mobile="{{ $mobile }}"
         data-autoplay="{{ $autoplay }}" data-autoplaydelay="{{ $autoplayDelay }}"
         data-autoplaydirection="{{ $autoplayDirection }}" data-speed="{{ $speed }}"
         data-loop="{{ $loop }}" data-pauseonhover="{{ $pauseOnHover }}" data-keyboard="{{ $keyboard }}"
         data-mousewheel="{{ $mousewheel }}" data-autoheight="{{ $autoHeight }}"
         data-deskspace="{{ $deskSpace }}" data-tabspace="{{ $tabSpace }}"
         data-phonespace="{{ $phoneSpace }}" data-id="{{ $id }}" data-pagination="{{ $pagination }}"
         data-navigation="{{ $navigation }}" data-width="{{ $width }}" data-direction="{{ $direction }}" id="{{ $id }}" x-ref="{{ $id }}">
        <div class="swiper-wrapper">
            {{ $slot }}
        </div>
    </div>
    <div class="slider-pag swiper-pagination "></div>
    @if (isset($navigation) && $navigation == 'true')
        <div class="navigation">
            <div class="slider-prev swiper-button-prev"></div>
            <div class="slider-next swiper-button-next"></div>
        </div>
    @endif --}}
</div>
