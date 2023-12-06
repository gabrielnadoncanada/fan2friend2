<a href="{{route('cart')}}" class="group flex items-center px-2">
    <img src="{{asset('svg/cart.svg')}}" alt="">
    <span
        class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">
        {{$cartCount}}</span>
    <span class="sr-only">items in cart, view bag</span>
</a>
