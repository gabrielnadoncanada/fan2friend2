<div class="pt-[85px]">
    @include('sections.breadcrumbs')
    <section>
        <div class="mx-auto max-w-[1440px] mb-[35px] flex ">
            <div class="w-full max-w-[585px]">
                <div class="featured-image">
                    <img width="585" height="585" class="aspect-square w-full rounded-[24px] object-cover"
                         src="{{$celebrity->image}}"
                         alt="{{$celebrity->username}}">
                </div>
                <ul class="grid grid-cols-4 gap-[23px] py-[24px]">
                    @foreach($celebrity->images as $image)
                        <li>
                            <a href="#">
                                <img src="{{$image}}" alt="" class="aspect-square rounded-[20px]">
                            </a>
                    @endforeach
                </ul>

                <div
                    class="bg-[#F7F7F7] rounded-[20px] flex flex-col gap-y-[10px] items-center justify-center px-[70px] py-[35px] text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48"
                         height="42" viewBox="0 0 48 42">
                        <defs>
                            <linearGradient id="linear-gradient" x2="1" y2="1" gradientUnits="objectBoundingBox">
                                <stop offset="0" stop-color="#fe3448"/>
                                <stop offset="1" stop-color="#e82399"/>
                            </linearGradient>
                        </defs>
                        <path id="Path_102" data-name="Path 102"
                              d="M0-26.634l-3.178-3.178-2.269-2.269A8.249,8.249,0,0,0-11.269-34.5,8.23,8.23,0,0,0-19.5-26.269a8.223,8.223,0,0,0,2.409,5.822l2.269,2.269L0-3.366,14.822-18.178l2.269-2.269A8.223,8.223,0,0,0,19.5-26.269,8.23,8.23,0,0,0,11.269-34.5a8.223,8.223,0,0,0-5.822,2.409L3.178-29.812ZM3.178-.178,0,3-3.178-.178-18-15l-2.269-2.269a12.723,12.723,0,0,1-3.731-9A12.731,12.731,0,0,1-11.269-39a12.723,12.723,0,0,1,9,3.731L0-33l2.269-2.269a12.754,12.754,0,0,1,9-3.722A12.717,12.717,0,0,1,24-26.269a12.723,12.723,0,0,1-3.731,9L18-15Z"
                              transform="translate(24 39)" fill="url(#linear-gradient)"/>
                    </svg>
                    <h3 class="text-[21px] font-bold leading-[28px]">
                        {{$celebrity->name}}, ainsi que Fan2Friend, reversent
                        partiellement ou en totalité les fonds à:
                    </h3>

                    <img src="https://placehold.co/275x73" alt="">

                </div>
            </div>

            <div class="col-span-6 col-start-7 max-w-[480px] mx-auto">
                <p class="text-[16px] text-primary-red leading-[21px]">{{$celebrity->category->name}}
                    : {{$celebrity->name}}</p>
                <h1 class="font-bold text-[54px] leading-[1] mb-[20px]">{{$celebrity->name}}</h1>
                <div class="text-[15px] leading-[20px] mb-[20px] flex flex-col gap-y-[20px]">
                    <p>{{$celebrity->description}}</p>
                </div>
                <div>
                    <div class="gradient-to-98 rounded-tl-[10px] rounded-tr-[10px] py-[5px]">
                        <p class="text-[18px] leading-[32px] font-bold text-white text-center">
                            Mes disponibilités
                        </p>
                    </div>

                    <livewire:celebrity.schedule></livewire:celebrity.schedule>
                    <div class="px-[24px] pt-[22px] pb-[18px] border border-[#D6D6D6] rounded-bl-[10px] rounded-br-[10px]">


                        <div class="flex items-center justify-between gap-x-2">
                            <button wire:click="prevMonth" class="ml-auto px-4 py-2  ">&lt;</button>
                            <span class="text-lg font-semibold">{{ $currentDate->localeMonth }} {{ $currentDate->year }}</span>
                            <button wire:click="nextMonth" class="mr-auto px-4 py-2">&gt;</button>
                        </div>

                        <div class="grid grid-cols-7 gap-4 mt-4 gradient-to-98 text-white h-[36px] items-center">
                            @foreach($daysOfWeek as $day)
                                <div class="text-center font-semibold">{{ __($day) }}</div>
                            @endforeach
                        </div>

                        <div class="grid grid-cols-7 gap-4 mt-4">
                            @for($i = 1; $i < $daysInMonth; $i++)

                                <div class="text-center flex items-center justify-center">
                                    <button @click="$wire.set('currentDate', {{$currentDate->setDay($i)}})"
                                        @class([
                                            'w-full rounded-[10px]',
                                            'gradient-to-98 text-white' => $i === $currentDate->day,
                                        ])>
                                        {{ $i }}
                                    </button>


                                    {{--                @foreach($dayInfo['events'] as $event)--}}
                                    {{--                    <div class="mt-1 text-xs bg-green-200 p-1 rounded">{{ $event }}</div>--}}
                                    {{--                @endforeach--}}
                                </div>
                            @endfor
                        </div>
                    </div>







                    <div class="flex gap-x-[18px] my-[30px] justify-between items-center">
                        <p>
                            Plages disponibles:
                        </p>
                        <ul class="flex gap-x-[7px]">
                            <li><p class="gradient-to-98 text-[13px] text-white font-bold py-[8px] px-[12px]">18h00&nbsp;-&nbsp;18h30</p>
                            </li>
                            <li><p class="font-bold text-[13px] py-[8px] px-[12px]">18h30&nbsp;-&nbsp;19h00</p></li>
                            <li><p class="font-bold text-[13px] py-[8px] px-[12px]">19h00&nbsp;-&nbsp;19h30</p></li>
                        </ul>
                    </div>
                    <x-button theme="gradient" class=" text-white block w-full">Réserver mon moment ─ <span
                            class="pl-[5px] font-bold">65$</span></x-button>
                </div>
            </div>
        </div>
    </section>
    @include('sections.how-it-work')
</div>
