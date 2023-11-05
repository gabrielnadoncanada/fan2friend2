<div style="display: none;" x-show="modals['{{ $id }}']"
    class="h-full w-screen fixed flex justify-center items-center p-4 top-0 z-[999]" {{ $attributes }}>
    <div x-show="modals['{{ $id }}']" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        x-description="Background backdrop, show/hide based on modal state."
        class="fixed inset-0 bg-foreground opacity-[0.65] transition-opacity" {{-- class="z-[-1] absolute h-full w-full  opacity-[0.65]" --}}
        @click="toggle('{{ $id }}')"></div>

    <div x-show="modals['{{ $id }}']" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-description="Modal panel, show/hide based on modal state."
        class="border-primary border overflow-y-auto max-h-[100vh] relative transform overflow-hidden rounded-lg p-6 xs:p-8 lg:px-20 pt-10  lg:pb-[4rem] bg-foreground text-left shadow-xl transition-all  sm:p-6"
        @click.away="open = false">
        @if ($title)
            <p class="text-3xl text-primary mb-12">{{ $title }}</p>
        @endif
        <div>{{ $slot }}</div>

        <x-button theme="ghost"
            class="absolute right-0 top-0 p-4 flex gap-x-[14px] text-primary items-center text-[24px]"
            @click="toggle('{{ $id }}')">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                <path d="M8.41748 8.41719L25.2519 25.2516" stroke="#ABE85E" stroke-width="2" stroke-linecap="round" />
                <path d="M25.2515 8.41719L8.41709 25.2516" stroke="#ABE85E" stroke-width="2" stroke-linecap="round" />
            </svg>Fermer</x-button>


    </div>
</div>
