<header class="absolute top-0 w-full left-0 z-10 h-[85px]">
    <div
        class=" border-[#D6D6D6]  max-w-[1440px]  mx-auto flex items-center justify-between gap-x-[30px] py-[20px]">
        <div class="flex gap-x-[72px] items-center">
            <a href="/" title="{{__('Back to home')}}">
                <img src="{{asset('svg/logo.svg')}}" alt="">
            </a>
        </div>

        <div class="flex items-center gap-x-4">
            <div class="flex items-center gap-x-2 mr-5">
                <x-header.language-switcher/>
                <livewire:cartCountComponent/>
            </div>

            @if(Auth::check())
                <div class="relative" x-data="Components.popover({ open: false, focus: false })" x-init="init()"
                     @keydown.escape="onEscape" @close-popover-group.window="onClosePopoverGroup">
                    <button type="button"
                            class="inline-flex items-center gap-x-1  pl-[40px] btn text-white gradient-to-98"
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
