<div class="pt-[85px]">
    <section>
        <div class="mx-auto max-w-[1440px] lg:grid lg:grid-cols-12 relative">
            <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-[70px] lg:py-[93px] xl:col-span-6 gradient-to-98">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h1 class="h1 text-white ">{{__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')}} </h1>

                </div>
            </div>
            <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0 lg:pr-8">
                <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
                     src="https://images.unsplash.com/photo-1498758536662-35b82cd15e29?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80"
                     alt="">
            </div>
        </div>
    </section>
    <section class="mt-[70px]">
        <div class="mx-auto max-w-[1440px] border-b border-[#D6D6D6] pb-[70px]">
            <div class="flex items-center gap-x-[8px] pb-[35px]">
                <h2 class="h2">{{__('Toutes les catégories')}}</h2>
                <p class="pt-[2px] text-[21px] leading-[41px] font-bold">- {{count($celebrities)}} personnalités</p>
            </div>
            <div class="grid grid-cols-12">
                <aside class="col-span-2 max-w-[220px]">
                    <h2 class="text-[21px] font-bold leading-[28px] mb-[15px]">Filtrer votre recherche</h2>
                    <fieldset class="border-b border-[#D6D6D6] my-[15px]">
                        <legend class="text-[16px] font-bold leading-[27px] mb-[12px]">Type de personnalité</legend>
                        <div class="pl-[15px] flex flex-col gap-y-[15px] pb-[15px]">
                            @foreach($categories as $category)
                                <label class="flex items-center gap-x-[8px]">
                                    <input type="checkbox" wire:model.live="selectedCategories" value="{{$category->slug}}">
                                    {{$category->name}}
                                </label>
                            @endforeach
                        </div>
                    </fieldset>

                </aside>
                <ul role="list"
                    class="pl-[70px] col-span-10 grid gap-x-[15px] gap-y-[30px] grid-cols-4 ">
                    @foreach($celebrities as $celebrity)
                        <li class="relative">
                            <img width="275" height="345" class="w-full rounded-[24px] object-cover mb-[17px]"
                                 src="{{$celebrity->image}}"
                                 alt="{{$celebrity->name}}">
                            <div class="flex flex-col gap-y-[8px] px-4">
                                <h3 class="h3 text-gradient">
                                    {{$celebrity->fullName}}</h3>
                                <p class="text-[15px] leading-[20px] text-dark-gray-2"> {{$celebrity->category->name}}
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
        </div>
    </section>
</div>
