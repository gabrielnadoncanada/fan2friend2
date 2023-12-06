<div class="pt-[85px]">
    <x-breadcrumbs :breadcrumbs="[
    ['route' => 'home', 'label' => __('app.home.breadcrumb')],
    ['label' => __('app.cart.breadcrumb')]]"
    />
    <section class="max-w-[1440px] mx-auto grid grid-cols-12 mb-[95px]">
        <h1 class="h1 col-span-12">{{__('app.cart.title')}} </h1>
    </section>

    <section class="max-w-[1440px] mx-auto grid grid-cols-12 gap-x-[24px] pb-[70px] border-b border-[#D6D6D6]">
        @if($content->count() <= 0)
            <div class="col-span-12">
                <p>
                    {{__('app.cart.empty_cart')}}
                </p>
            </div>
        @else
            <div class="col-span-6">
                <x-cart-list :content="$content"/>
            </div>

            <div class="col-span-6 ">
                <div class="bg-[#F2F2F2] max-w-[465px] mx-auto rounded-[20px] pt-[40px] px-[35px] pb-[48px] sticky top-0">
                    <x-order-summary
                        :subtotal="$subtotal"
                        :taxes="$taxes"
                        :total="$total"
                        :content="$content"
                    />
                    <x-button href="{{route('checkout')}}" theme="gradient" class="block w-full text-white mt-6">
                        {{__('app.cart.button_text')}}
                    </x-button>
                </div>
            </div>
        @endempty
    </section>
</div>
