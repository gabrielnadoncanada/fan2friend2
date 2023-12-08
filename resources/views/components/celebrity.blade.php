<li class="max-w-[275px] relative mr-[15px]">
    <img width="275" height="345"
         class="w-full rounded-[24px] object-cover mb-[17px] aspect-[1/1.25]"
         src="{{$celebrity->image ??  asset('images/placeholder.png') }}"
         alt="{{$celebrity->full_name}}">
    <div class="flex flex-col gap-y-[8px] px-4">
        <h3 class="h3 text-gradient">
            {{$celebrity->full_name}}</h3>
        <p class="text-[15px] leading-[20px] text-dark-gray-2">{{$celebrity->category->title}}
            · {{$celebrity->full_name}}</p>
        <p class="text-[18px] text-almost-black font-bold">
            {{__('app.personality.starting_at', ['price' => $celebrity->price])}}
        </p>
    </div>
    <a href="{{route('celebrity.show', ['category' => $celebrity->category->slug, 'celebrity' => $celebrity->slug])}}"
       class="inset-0 absolute w-full h-full"></a>
</li>
