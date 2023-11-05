<div class="pt-[85px]">
    <section>
        <div class="mx-auto max-w-[1440px] lg:grid lg:grid-cols-12 relative">
            <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-[70px] lg:py-[93px] xl:col-span-6 gradient-to-98">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h1 class="h1 text-white ">{{__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')}} </h1>
                    <p class="mt-6 p text-white">
                        {{__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra pretium tortor, eu
                        mattis sapien ornare in. In hac habitasse platea dictumst suspendisse tincidunt.')}}
                    </p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <x-button href="{{route('celebrity.index')}}">
                            {{__('Découvrez nos personnalités')}}
                        </x-button>
                    </div>
                </div>
            </div>
            <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0 lg:pr-8">
                <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
                     src="https://images.unsplash.com/photo-1498758536662-35b82cd15e29?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80"
                     alt="">
            </div>
        </div>
    </section>

    <section class="my-[70px]">
        <div class="mx-auto max-w-[1440px] ">
            <div class="flex justify-between gap-x-[30px] items-center">
                <h2 class="h2 text-gradient">{{__('Personalités récentes')}}</h2>
                <x-button href="{{route('celebrity.index')}}"
                          class="text-[16px] font-bold text-almost-black">{{__('Toutes nos personnalités')}}</x-button>
            </div>
            <ul role="list" class="grid gap-x-[15px] grid-cols-5 border-b border-[#D6D6D6] pt-[30px] pb-[35px]">
                @foreach($latestCelebrities as $celebrity)
                    <li class="relative">
                        <img width="275" height="345" class="w-full rounded-[24px] object-cover mb-[17px]"
                             src="{{$celebrity->image}}"
                             alt="{{$celebrity->name}}">
                        <div class="flex flex-col gap-y-[8px] px-4">
                            <h3 class="h3 text-gradient">
                                {{$celebrity->fullName}}</h3>
                            <p class="text-[15px] leading-[20px] text-dark-gray-2">{{$celebrity->category->name}}
                                · {{$celebrity->nickname}}</p>
                            <p class="text-[18px] text-almost-black font-bold">
                                À partir de 99$</p>
                        </div>
                        <a href="{{route('celebrity.show', ['category' => $celebrity->category->slug, 'celebrity' => $celebrity->slug])}}"
                           class="inset-0 absolute w-full h-full"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="my-[70px]">
        <div class="mx-auto max-w-[1440px] border-b border-[#D6D6D6] ">
            <div class="flex justify-between gap-x-[30px] items-center">
                <h2 class="h2 text-gradient">{{__('Personalités en vedette')}}</h2>
                <x-button href="{{route('celebrity.index')}}"
                          class="text-[16px] font-bold text-almost-black">{{__('Toutes nos personnalités')}}</x-button>
            </div>
            <ul role="list" class="grid gap-x-[15px] grid-cols-5 pt-[30px] pb-[35px]">
                @foreach($featuredCelebrities as $celebrity)
                    <li class="relative">
                        <img width="275" height="345" class="w-full rounded-[24px] object-cover mb-[17px]"
                             src="{{$celebrity->image}}"
                             alt="{{$celebrity->username}}">
                        <div class="flex flex-col gap-y-[8px] px-4">
                            <h3 class="h3 text-gradient">
                                {{$celebrity->fullName}}</h3>
                            <p class="text-[15px] leading-[20px] text-dark-gray-2">{{$celebrity->category->name}}
                                · {{$celebrity->nickname}}</p>
                            <p class="text-[18px] text-almost-black font-bold">
                                À partir de 99$</p>
                        </div>
                        <a href="{{route('celebrity.show', ['category' => $celebrity->category->slug, 'celebrity' => $celebrity->slug])}}"
                           class="inset-0 absolute w-full h-full"></a>
                    </li>
                @endforeach
            </ul>
            <div class="text-center mt-[10px] mb-[35px]">
                <x-button href="{{route('celebrity.index')}}"
                          theme="gradient">{{__('Toutes nos personnalités')}}</x-button>
            </div>

        </div>
    </section>
    <section class="my-[70px]">
        <div class="mx-auto max-w-[1440px] ">
            <div class="flex justify-between gap-x-[30px] items-center">
                <h2 class="h2 text-gradient">{{__('Catégories de personalités')}}</h2>
            </div>
            <ul role="list" class="grid gap-x-[15px] grid-cols-5 pt-[30px] ">
                @foreach($categories as $category)
                    <li class="relative">
                        <img width="275" height="345" class="w-full rounded-[24px] object-cover"
                             src="{{$category->image}}"
                             alt="{{$category->name}}">
                        <div
                            class="flex items-end gap-y-[8px] px-4 pb-[70px] w-full h-full justify-center absolute left-0 top-0">
                            <h3 class="text-[18px] font-bold leading-[24px] text-white">
                                {{$category->name}}</h3>
                        </div>
                        <a href="{{route('celebrity.index', ['category' => $category->slug])}}"
                           class="inset-0 absolute w-full h-full"></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    @include('sections.how-it-work')
    <section class="py-[90px]">
        <div class="mx-auto max-w-[1440px] lg:grid lg:grid-cols-12 relative">
            <div
                class="pr-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:pr-[70px] lg:py-[93px] xl:col-span-6 flex flex-col justify-center">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h1 class="font-bold text-[36px] leading-[48px]">{{__('Suspendisse semper dui sed gravidaiaculis. Donec a massa at arculobortis bibendum. ')}} </h1>
                    <div class="mt-5 flex items-center gap-x-6">
                        <x-button theme="gradient" href="{{route('celebrity.index')}}">
                            {{__('Toutes nos personnalités')}}
                        </x-button>
                    </div>
                </div>
            </div>
            <div class="relative lg:col-span-5 lg:-mr-8  xl:mr-0 lg:pr-8">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="708"
                     height="543.301" viewBox="0 0 708 543.301">
                    <defs>
                        <linearGradient id="linear-gradient" x1="0.22" y1="0.76" x2="0.819" y2="-0.021"
                                        gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#fe3448"/>
                            <stop offset="1" stop-color="#e82399"/>
                        </linearGradient>
                    </defs>
                    <path id="sigle"
                          d="M1183.8,456.416C1183.8,328.808,1063.847,225,916.4,225c-112.556,0-209.051,60.549-248.432,145.905q11.327-1.076,23.03-1.093a245.67,245.67,0,0,1,35.366,2.529c36.22-56.585,107.823-95.2,190.019-95.2,118.672,0,215.2,80.385,215.2,179.221s-96.547,179.221-215.2,179.221-215.2-80.385-215.2-179.221a152.481,152.481,0,0,1,1.384-19.836c90.14,4.972,161.641,67.571,161.641,143.906a123.086,123.086,0,0,1-2.956,26.533,260.459,260.459,0,0,0,41.909,4.63,163.07,163.07,0,0,0,3.058-31.112c0-102.7-96.547-186.243-215.2-186.243S475.8,477.772,475.8,580.486c0,44.882,18.452,86.074,49.085,118.245L506.348,768.3,567.29,732.7c35.024,21.408,77.7,34.033,123.729,34.033,74.319,0,139.891-32.786,178.606-82.537a307.4,307.4,0,0,0,46.83,3.639c57.2,0,110.215-15.684,153.747-42.251l75.7,44.216-23.031-86.45C1160.906,563.316,1183.8,512.129,1183.8,456.416ZM691.019,724.666c-95.539,0-173.207-64.718-173.207-144.231,0-67.673,56.295-124.6,131.947-140.079-.427,5.313-.718,10.61-.718,16.009,0,99.263,72.645,184.141,174.352,216.927C791.513,704.694,744.068,724.666,691.019,724.666Z"
                          transform="translate(-475.8 -225)" fill="url(#linear-gradient)"/>
                </svg>

            </div>
        </div>
    </section>
    <section class="bg-[#F7F7F7] py-[120px] text-center">
        <div class="mx-auto max-w-[1440px] flex items-center justify-between">
            <h2 class="text-[36px] font-bold text-almost-black pr-[100px]">{{__('Nos partenaires')}}</h2>
            <ul role="list" class="grid gap-x-[15px] grid-cols-5 ">
                @php
                    $partners = [
                        ['title' => 'Partenaire 1'],
                        ['title' => 'Partenaire 2'],
                        ['title' => 'Partenaire 3'],
                        ['title' => 'Partenaire 4'],
                        ['title' => 'Partenaire 5'],
                    ];
                @endphp
                @forEach($partners as $partner)
                    <li>
                        <img width="275" height="345" class="w-full rounded-[24px] object-cover"
                             src="https://placehold.co/185x50"
                             alt="{{$partner['title']}}">
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
