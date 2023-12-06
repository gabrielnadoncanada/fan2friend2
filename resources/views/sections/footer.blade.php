<div class="max-w-[1440px] mx-auto px-6">

        <div class="grid grid-cols-12 pt-[55px] pb-[60px] gap-y-12 gap-x-6">
            <div class="col-span-12 col-span-5 lg:col-span-4">
                <h2 class="text-[21px] leading-[28px] font-medium mb-[5px]">
                    {{__('app.footer.newsletter.title')}}

                </h2>
                <p>
                    {{__('app.footer.newsletter.description')}}
                </p>
                <form action="#" method="post" class="mt-[24px]  relative">
                    <label>
                        <input type="email" name="email" placeholder=" {{__('app.footer.newsletter.placeholder')}}"
                               required
                               class="border border-transparent pr-[150px] bg-[#F7F7F7] leading-[0] border-0 border-[#D6D6D6] text-almost-black rounded-full w-full px-6 min-h-[44px] py-[10px] ">
                    </label>
                    <x-button theme="gradient" class="absolute right-0 py-[12px]">
                        {{__('app.footer.newsletter.button_text')}}
                    </x-button>

                </form>
            </div>

            <nav class="col-span-6 lg:col-start-6 lg:col-span-2">
                <ul>
                    <li><a href="{{route('faqs')}}"
                           class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.0.title')}}</a>
                    </li>

                    <li><a href="{{route('contact')}}"
                           class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.2.title')}}</a>
                    </li>


                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.3.title')}}</a>
                    </li>
                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.4.title')}}</a>
                    </li>
                </ul>
            </nav>

            <nav class="col-span-6 lg:col-span-2 flex lg:justify-center">
                <ul>
                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.1.title')}}</a>
                    </li>
                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.5.title')}}</a>
                    </li>

                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.7.title')}}</a>
                    </li>
                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.8.title')}}</a>
                    </li>
                    <li><a
                            class="leading-[31px] text-[18px] text-almost-black">{{__('app.footer.menu.items.9.title')}}</a>
                    </li>
                </ul>
            </nav>

            <div class="col-span-12 lg:col-span-3 flex lg:justify-center">
                <div>
                    <h2 class="mb-[24px] text-[18px] leading-[21px]">{{__('app.footer.personalities.title')}}</h2>
                    <x-button theme="gradient">{{__('app.footer.personalities.button_text')}}</x-button>
                </div>

            </div>
        </div>

</div>

