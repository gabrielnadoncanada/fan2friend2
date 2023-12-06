<div class="pt-[85px]">
    <x-breadcrumbs :breadcrumbs="[
        ['route' => 'home', 'label' => __('app.home.breadcrumb')],
        ['route' => 'celebrity.index', 'label' => __('app.personalities.breadcrumb')],
        [
            'route' => 'celebrity.index',
            'label' => $celebrity->category->title,
            'params' => ['category' => $celebrity->category->slug],
        ],
        ['label' => $celebrity->full_name],
    ]">
    </x-breadcrumbs>

    @php
        $images = $celebrity->images->isEmpty() ? collect([asset('/images/placeholder.png')]) : collect($celebrity->images)->prepend($celebrity->image);
    @endphp
    <section>
        <div class="mx-auto max-w-[1440px] mb-[35px] flex ">
            <div class="w-full max-w-[585px]">
                <div class="flex flex-col-reverse mb-7" x-data="Components.tabs()" @tab-click.window="onTabClick"
                     @tab-keydown.window="onTabKeydown">
                    <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
                        <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                            @foreach ($images as $key => $image)
                                <button id="tabs-2-tab-{{$key}}"
                                        class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4"
                                        x-data="Components.tab(0)" aria-controls="tabs-2-panel-{{$key}}" role="tab"
                                        x-init="init()" @click="onClick" @keydown="onKeydown"
                                        @tab-select.window="onTabSelect" :tabindex="selected ? 0 : -1"
                                        :aria-selected="selected ? 'true' : 'false'" type="button" tabindex="0"
                                        aria-selected="true">
                                    <span class="absolute inset-0 overflow-hidden rounded-md">
                                    <img src="{{ $image }}" alt="{{ $celebrity->full_name }}"
                                         class="h-full w-full object-cover object-center aspect-square">
                                </span>
                                    <span
                                        class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-offset-2 ring-indigo-500"
                                        aria-hidden="true" x-state:on="Selected" x-state:off="Not Selected"
                                        :class="{ 'ring-indigo-500': selected, 'ring-transparent': !(selected) }"></span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="aspect-h-1 aspect-w-1 w-full">
                        @foreach ($images as $key => $image)
                            <div id="tabs-2-panel-{{$key}}"
                                 x-data="Components.tabPanel(0)" aria-labelledby="tabs-{{$key}}-tab-{{$key}}"
                                 x-init="init()"
                                 x-show="selected" @tab-select.window="onTabSelect" role="tabpanel" tabindex="0">
                                <img src="{{ $image }}"
                                     alt="{{ $celebrity->full_name }}"
                                     class="h-full w-full object-cover aspect-square object-center sm:rounded-lg">
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($celebrity->partner)
                    <div
                        class="bg-[#F7F7F7] rounded-[20px] flex flex-col gap-y-[10px] items-center justify-center px-[70px] py-[35px] text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48"
                             height="42" viewBox="0 0 48 42">
                            <defs>
                                <linearGradient id="linear-gradient" x2="1" y2="1"
                                                gradientUnits="objectBoundingBox">
                                    <stop offset="0" stop-color="#fe3448"/>
                                    <stop offset="1" stop-color="#e82399"/>
                                </linearGradient>
                            </defs>
                            <path id="Path_102" data-name="Path 102"
                                  d="M0-26.634l-3.178-3.178-2.269-2.269A8.249,8.249,0,0,0-11.269-34.5,8.23,8.23,0,0,0-19.5-26.269a8.223,8.223,0,0,0,2.409,5.822l2.269,2.269L0-3.366,14.822-18.178l2.269-2.269A8.223,8.223,0,0,0,19.5-26.269,8.23,8.23,0,0,0,11.269-34.5a8.223,8.223,0,0,0-5.822,2.409L3.178-29.812ZM3.178-.178,0,3-3.178-.178-18-15l-2.269-2.269a12.723,12.723,0,0,1-3.731-9A12.731,12.731,0,0,1-11.269-39a12.723,12.723,0,0,1,9,3.731L0-33l2.269-2.269a12.754,12.754,0,0,1,9-3.722A12.717,12.717,0,0,1,24-26.269a12.723,12.723,0,0,1-3.731,9L18-15Z"
                                  transform="translate(24 39)" fill="url(#linear-gradient)"/>
                        </svg>
                        <h3 class="text-[21px] font-bold leading-[28px]">
                            {{__('app.personality.donation', ['personality' => $celebrity->full_name])}}
                        </h3>
                        <img src="https://placehold.co/275x73" alt="">
                    </div>
                @endif

            </div>

            <div class="col-span-6 col-start-7 max-w-[480px] mx-auto">
                <p class="text-[16px] text-primary-red leading-[21px] capitalize">{{ $celebrity->category->title }}
                    : {{ $celebrity->full_name }}</p>
                <h1 class="font-bold text-[54px] leading-[1] mb-[20px]">{{ $celebrity->full_name }}</h1>
                <div class="text-[15px] leading-[20px] mb-[20px] flex flex-col gap-y-[20px]">
                    <p class="leading-[1.7]">{{ $celebrity->description }}</p>
                </div>
                <div>
                    <div class="gradient-to-98 rounded-tl-[10px] rounded-tr-[10px] py-[5px]">
                        <p class="text-[18px] leading-[32px] font-bold text-white text-center">
                            {{__('app.personality.calendar_label')}}
                        </p>
                    </div>
                    <div id="calendar" wire:ignore
                         class="px-[24px] pb-[18px]  text-center border border-[#D6D6D6] rounded-bl-[10px] rounded-br-[10px] border-separate">
                    </div>
                    <form wire:submit="addToCart" class="mt-[30px]">

                        @if($selectedDate)

                            <div class="grid grid-cols-12  justify-between">
                                <p class="col-[1/4] whitespace-nowrap leading-[36px]">
                                    {{__('app.personality.options_label')}}
                                </p>
                                <div class="col-[5/13] grid grid-cols-2 gap-2 " id="intervals">
                                    @empty(!$intervals)
                                        @foreach ($intervals as $key => $interval)
                                            <div>
                                                <x-form.radio
                                                    id="selected_interval_{{ $key }}"
                                                    name="selectedIntervalId"
                                                    wire:model="selectedIntervalId"
                                                    value="{{ $interval['id'] }}"
                                                    class="peer hidden"
                                                ></x-form.radio>
                                                <x-form.label
                                                    for="selected_interval_{{ $key }}"
                                                    class="block cursor-pointer select-none py-[8px] px-[12px] text-center border font-bold  text-[13px]"
                                                >
                                                    {!! $interval['start_time'] . '&nbsp;-&nbsp;' . $interval['end_time'] !!}
                                                </x-form.label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="col-[1/4] whitespace-nowrap leading-[36px]">
                                            {{__('app.personality.no_availability')}}
                                        </p>

                                    @endempty
                                </div>
                            </div>
                            <x-form.error for="selectedTimeSlot"/>
                            <x-button theme="gradient" type="submit" class="mt-[30px] text-white block w-full">

                                {{__('app.personality.button_text')}}
                                <span class="pl-[5px] font-bold">{{ $celebrity->price }}$</span>
                            </x-button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        var availabilities = @json($availabilities);
    </script>
    @include('sections.how-it-work')
    @include('sections.footer')

</div>
