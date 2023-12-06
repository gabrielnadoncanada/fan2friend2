<h2 class="h2 mb-[30px]">{{__('app.checkout.orderSummaryTitle')}}</h2>
<div class="w-full">
    <div class="flex flex-col gap-y-4">
        @foreach($content as $id => $item)
            <div class="flex">
                <div>
                    <img src="{{ $item->get('options')['image'] }}"
                         class="aspect-square rounded-[10px] mr-[12px]" alt="{{ $item->get('name') }}" width="60"
                         height="60">
                </div>
                <div class="flex flex-1 pt-2 gap-x-4">
                    <div>
                        <p class="text-[16px] font-bold">{{ $item->get('quantity') }}x</p>
                    </div>
                    <div class="flex flex-col ">
                        <p class="text-[16px] font-bold">{{ $item->get('name') }}</p>
                        <p class="text-[15px] ">{{ $item->get('options')['scheduled_date'] }}
                            - {{ $item->get('options')['start_time'] }}</p>
                    </div>
                </div>
                <div class="text-center font-bold text-[16px] pt-2">
                    {{ $item->get('price') }}$
                </div>
            </div>
        @endforeach
    </div>
    <p class="border-b border-[#D6D6D6] py-6 flex justify-between">
        <span>{{__('app.checkout.subtotal')}}</span>
        <span class="text-center  text-[16px]">{{$subtotal}}$</span>
    </p>
    <div class="flex flex-col gap-y-4 py-6 border-b border-[#D6D6D6]">
        @if($taxes && count($taxes) > 0)
            @foreach($taxes as $tax => $amount)
                <p class="flex justify-between">
                    <span>Taxe ({{__('taxes.'.$tax)}})</span>
                    <span class="text-center text-[16px]">{{$amount}}$</span>
                </p>
            @endforeach
        @endif
        <p class="flex justify-between">
            <span class="font-bold">{{__('app.checkout.total')}}</span>
            <span class="text-center font-bold text-[16px]">{{$total}}$</span>
        </p>
    </div>
</div>

