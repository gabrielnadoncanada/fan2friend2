@if($partners->isNotEmpty())
    <section class="bg-[#F7F7F7] py-[120px] text-center">
        <div class="mx-auto max-w-[1440px] ">
            <div class="container">
                <div class="flex items-center justify-between">

                    <h2 class="text-[36px] font-bold text-almost-black pr-[100px]">
                        {{__('app.home.partners.title')}}
                    </h2>
                    <ul role="list" class="grid gap-x-[15px] grid-cols-5 ">
                        @forEach($partners as $partner)
                            <li>
                                <img width="275" height="345" class="w-full rounded-[24px] object-cover"
                                     src="{{$partner['image']}}"
                                     alt="{{$partner['title']}}">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif
