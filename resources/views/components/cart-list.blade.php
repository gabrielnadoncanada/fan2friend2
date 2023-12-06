<table class="w-full">
    <thead>
    <tr class="border-b border-[#D6D6D6] pb-[6px]">
        <th colspan="2"
            class="text-left font-bold text-[15px] leading-[25px]">{{__('app.cart.remove_from_cart')}}</th>
        <th colspan="2"
            class="text-left font-bold text-[15px] leading-[25px]">{{__('app.cart.quantity')}}</th>
        <th colspan="8"
            class="text-left font-bold text-[15px] leading-[25px]">{{__('app.cart.product')}}</th>
        <th colspan="2"
            class="text-right font-bold text-[15px] leading-[25px]">{{__('app.cart.subtotal')}}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($content as $id => $item)
        <tr class="border-b border-[#D6D6D6]">
            <td colspan="2" class="py-[24px]">
                <div class="w-[48px] text-center" wire:click="removeFromCart({{ $id }})">X
                </div>
            </td>
            <td colspan="2">
                <div class="isolate inline-flex rounded-md shadow-sm">
                    <button type="button"
                            wire:click="updateCartItem({{ $id }}, 'minus')"
                            class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                        -
                    </button>
                    <div
                        class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">{{ $item->get('quantity') }}</div>
                    <button type="button"
                            wire:click="updateCartItem({{ $id }}, 'plus')"
                            class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                        +
                    </button>
                </div>
            </td>
            <td colspan="8" class="py-[24px]">
                <div class="flex items-center">
                    <img src="{{ $item->get('options')['image'] }}"
                         class="aspect-square rounded-[10px] mr-[12px]" alt="" width="90" height="60">
                    <div>
                        <p class="text-[16px] font-bold">{{ $item->get('name') }}</p>
                        <p class="text-[15px] ">{{ $item->get('options')['scheduled_date'] }}
                            - {{ $item->get('options')['start_time'] }}
                        </p>
                    </div>
                </div>
            </td>
            <td colspan="2" class="text-right font-bold text-[16px] py-[24px]">

                {{ $item->get('subtotal') }}$
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
