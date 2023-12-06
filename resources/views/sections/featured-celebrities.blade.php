@if($featuredCelebrities->isNotEmpty())
    <section class="my-[70px]"
             x-data="{ carousel: null }"
             x-init="carousel = new Flickity(document.querySelector('#featured-celebrities'), {
                    draggable: true,
                    wrapAround: true,
                    cellAlign: 'left',
                    prevNextButtons: false,
                    dragThreshold: 10,
                    pageDots: false
                });"
    >
        <div class="mx-auto max-w-[1440px] border-b border-[#D6D6D6] pb-[30px]">
            <div class="flex justify-between gap-x-[30px] items-center">
                <div class="flex items-center">
                    <h2 class="h2 text-gradient mr-[30px]">{{__('app.home.featured_personalities.title')}}</h2>
                    <button @click="carousel.previous()" class="flex arrow-previous mr-4 text-[2rem]"></button>
                    <button @click="carousel.next()" class="flex arrow-next text-[2rem]"></button>
                </div>
                <x-button href="{{route('celebrity.index')}}" class="text-[16px] font-bold text-almost-black flex arrow-next gap-x-2">
                    {{__('app.home.featured_personalities.button_text')}}
                </x-button>
            </div>
            <ul id="featured-celebrities" role="list" class="pt-[30px] pb-[35px]">
                @foreach($featuredCelebrities as $celebrity)
                    <x-celebrity :celebrity="$celebrity"/>
                @endforeach
            </ul>
            <div class="text-center mt-[35px] mb-[35px]">
                <x-button href="{{route('celebrity.index')}}"
                          theme="gradient">{{__('app.home.featured_personalities.button_text')}}</x-button>
            </div>
        </div>
    </section>
@endif
