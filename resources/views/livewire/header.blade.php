<header class="w-full left-0 z-10 bg-white">
    <div class="border-[#D6D6D6] flex flex-col-reverse lg:flex-row lg:items-center  max-w-[1440px]
         mx-auto  lg:justify-normal justify-between gap-x-[30px] lg:py-[20px] lg:px-4">
        <a href="/" title="{{__('Back to home')}}" class="max-w-[175px]">
            <img src="{{asset('svg/logo.svg')}}" alt="">
        </a>
        <x-header.search :search="$search" :celebrities="$celebrities"/>
        <x-header.language-switcher class="ml-auto"/>
        <x-header.cart-count :cart-count="$cartCount"/>
        <div class="order-4">
            @if(Auth::check())
                <div class="relative" x-data="Components.popover({ open: false, focus: false })" x-init="init()"
                     @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup">
                    <button type="button"
                            class="inline-flex items-center gap-x-1  max-lg:px-0 lg:pl-[40px] btn text-white gradient-to-98"
                            @click="toggle" @mousedown="if (open) $event.preventDefault()" aria-expanded="true"
                            :aria-expanded="open.toString()">
                        <span>{{__('app.header.options')}}</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         x-description="Flyout menu, show/hide based on flyout menu state."
                         class="absolute right-[-10px] z-10 mt-5 flex w-screen max-w-min  px-4" x-ref="panel"
                         @click.away="open = false">
                        <div
                            class="w-56 shrink rounded-xl bg-white p-4 text-sm font-semibold leading-6 text-gray-900 shadow-lg ring-1 ring-gray-900/5">
                            <a href="/dashboard"
                               class="block p-2 hover:text-indigo-600">{{__('app.header.dashboard')}}</a>

                            <form action="{{route('filament.admin.auth.logout')}}" method="POST">
                                @csrf
                                <button class="block p-2 hover:text-indigo-600">{{__('app.header.logout')}}</button>
                            </form>
                        </div>

                    </div>
                </div>
            @else
                <a href="{{route('filament.admin.auth.login')}}"
                   class="btn text-white gradient-to-98">{{ __('Connexion') }}</a>
            @endif
        </div>
    </div>
</header>
