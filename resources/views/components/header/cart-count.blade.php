<a href="{{route('cart')}}" {{$attributes->class(['group flex items-center lg:pr-2'])}}>
    <img class="invert lg:invert-0" src="{{asset('svg/cart.svg')}}" alt="">
    <span
        class="text-white ml-2 text-sm font-medium lg:text-gray-700 group-hover:text-gray-800">
        {{$cartCount}}</span>
    <span class="sr-only">items in cart, view bag</span>
</a>
