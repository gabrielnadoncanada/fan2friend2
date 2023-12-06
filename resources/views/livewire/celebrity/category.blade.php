<div class="pt-[85px]">
    @include('sections.hero',[
     'title' => __('app.home.hero.title'),
     'imageUrl' => 'https://images.unsplash.com/photo-1498758536662-35b82cd15e29?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2102&q=80'
 ])
    <section class="mt-[70px]">
        <div class="mx-auto max-w-[1440px] border-b border-[#D6D6D6] pb-[70px]">
            <div class="flex items-center gap-x-[8px] pb-[35px]">
                <h2 class="h2">{{__('app.personalities.categories.title')}} </h2>
                <p class="pt-[2px] text-[21px] leading-[41px] font-bold">
                    {{__('app.personalities.categories.total', ['count' => $celebrities->total()])}}</p>
            </div>
            <div class="grid grid-cols-12">
                <x-sidebar :categories="$categories"/>
                <div class="pl-[70px] col-span-10" x-data="{ atBottom: false }">
                    <ul role="list" class="grid gap-x-[15px] gap-y-[30px] grid-cols-4 ">
                        @foreach($celebrities as $celebrity)
                            <x-celebrity :celebrity="$celebrity"/>
                        @endforeach
                    </ul>
                    <div x-show="atBottom" wire:loading id="load-more">
                        <div class="loader">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div
        x-data="{
        observe () {
            let observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.call('loadMore')
                    }
                })
            }, {
                root: null
            })

            observer.observe(this.$el)
        }
    }"
        x-init="observe"
    ></div>

    @include('sections.footer')

</div>
