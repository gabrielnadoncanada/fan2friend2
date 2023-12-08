<div class="">
    <x-breadcrumbs :breadcrumbs="[['route' => 'home', 'label' => __('app.home.breadcrumb')],
        ['route' => 'cart', 'label' => __('app.cart.breadcrumb')],
['label' => __('app.checkout.breadcrumb')]]"/>
    <section class="max-w-[1440px] mx-auto grid grid-cols-12 mb-[95px]">
        <h1 class="h1 col-span-12">{{__('app.checkout.title')}} </h1>
    </section>
    <section class="max-w-[1440px] mx-auto grid grid-cols-12 gap-x-[24px] pb-[70px] border-b border-[#D6D6D6]">
        <div class="col-span-6">
            <x-order-billing-details
                :subtotal="$subtotal"
                :taxes="$taxes"
                :total="$total"
                :content="$content"
            />
        </div>
        <div class="col-span-6 ">
            <div class="bg-[#F2F2F2] max-w-[465px] mx-auto rounded-[20px] pt-[40px] px-[35px] pb-[48px] sticky top-0">
                <x-order-summary
                    :subtotal="$subtotal"
                    :taxes="$taxes"
                    :total="$total"
                    :content="$content"
                />
                <x-order-payment/>
                <x-button wire:click="submit" theme="gradient" class="block w-full text-white mt-6">
                    {{__('app.cart.button_text')}}
                </x-button>
            </div>
        </div>
    </section>
</div>


