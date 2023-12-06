@if($latestCelebrities->isNotEmpty())
    <section class="my-[70px]"
             x-data="{ carousel: null }"
             x-init="carousel = new Flickity(document.querySelector('#latest-celebrities'), {
                    draggable: true,
                    wrapAround: true,
                    cellAlign: 'left',
                    prevNextButtons: false,
                    dragThreshold: 10,
                    pageDots: false
                });">
        <div class="mx-auto max-w-[1440px] ">

            <div class="flex justify-between gap-x-[30px] items-center">
                <div class="flex items-center">
                    <h2 class="h2 text-gradient mr-[30px]">{{__('app.home.recent_personalities.title')}}</h2>
                    <button @click="carousel.previous()" class="arrow-previous text-[2rem] mr-4 flex"></button>
                    <button @click="carousel.next()" class="arrow-next flex text-[2rem]"></button>
                </div>
                <x-button href="{{route('celebrity.index')}}"
                          class="text-[16px] font-bold text-almost-black flex arrow-next gap-x-2">
                    {{__('app.home.recent_personalities.button_text')}}</x-button>
            </div>
            <ul id="latest-celebrities" role="list" class="border-b border-[#D6D6D6] pt-[30px] pb-[35px]">
                @foreach($latestCelebrities as $celebrity)
                    <x-celebrity :celebrity="$celebrity"/>
                @endforeach
            </ul>
        </div>

    </section>
@endif
