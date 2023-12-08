@unless($categories->isEmpty())
    <section class="my-8 lg:my-16"
             x-data="{ carousel: null }"
             x-init="carousel = new Flickity(document.querySelector('#featured-categories'), {
                    draggable: true,
                    wrapAround: true,
                    cellAlign: 'left',
                    prevNextButtons: false,
                    dragThreshold: 10,
                    pageDots: false
                });"
    >
        <div class="mx-auto max-w-[1440px] ">
            <div class="flex items-center max-lg:flex-1 max-lg:justify-between">
                <h2 class="h2 text-gradient mr-[30px]">{{__('app.home.category_personalities.title')}}</h2>
                <div class="flex items-center">
                    <button @click="carousel.previous()" class="flex arrow-previous mr-4 text-[2rem]"></button>
                    <button @click="carousel.next()" class="flex arrow-next text-[2rem]"></button>
                </div>
            </div>
            <ul id="featured-categories" role="list" class="pt-[30px] ">
                @foreach($categories as $category)
                    <li class="max-w-[275px] mr-[15px] ">
                        <img width="275" height="345" class="w-full rounded-[24px] object-cover  aspect-[1/1.25]"
                             src="{{optional($category->image)->url ?? asset('images/placeholder.png')}}"
                             alt="{{$category->title}}">
                        <div
                            class="flex items-end gap-y-[8px] px-4 pb-[70px] w-full h-full justify-center absolute left-0 top-0">
                            <h3 class="text-[18px] font-bold leading-[24px] text-white">
                                {{$category->title}}</h3>
                        </div>
                        <a href="{{route('celebrity.index', ['category' => $category->slug])}}"
                           class="inset-0 absolute w-full h-full"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endunless
