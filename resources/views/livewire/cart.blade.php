<div class="pt-[85px]">
    @include('sections.breadcrumbs')
    <section class="max-w-[1440px] mx-auto grid grid-cols-12 mb-[95px]">
        <h1 class="h1 col-span-12">{{__('Passez votre commande')}} </h1>
    </section>

    <section class="max-w-[1440px] mx-auto grid grid-cols-12 gap-x-[24px] pb-[70px] border-b border-[#D6D6D6]">
        <div class="col-span-6">
            <table class="w-full ">
                <thead>
                <tr class="border-b border-[#D6D6D6] pb-[6px]">
                    <th colspan="2" class="text-left  font-bold text-[15px] leading-[25px]">Retirer</th>
                    <th colspan="8" class="text-left font-bold text-[15px] leading-[25px]">Produit</th>
                    <th colspan="2" class=" text-right font-bold text-[15px] leading-[25px]">Sous-total</th>
                </tr>
                </thead>
                <tbody>
                <tr class="border-b border-[#D6D6D6]">
                    <td colspan="2" class="py-[24px]">
                        <div class="w-[48px] text-center">X</div>
                    </td>
                    <td colspan="8" class="py-[24px]">
                        <div class="flex items-center">
                            <img src="https://placehold.co/60x60" class="aspect-square rounded-[10px] mr-[12px]"
                                 alt="">
                            <div>
                                <p class="text-[16px] font-bold">Hasan Piker</p>
                                <p class="text-[15px] ">16 septembre 2023 - 18h00-19h00</p>
                            </div>
                        </div>
                    </td>
                    <td colspan="2" class="text-right font-bold text-[16px] py-[24px]">
                        65$
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-span-6 ">
            <div class="bg-[#F2F2F2] max-w-[465px] mx-auto rounded-[20px] pt-[40px] px-[35px] pb-[48px]">
                <h2 class="h2 mb-[30px]">Sommaire de la commande</h2>
                <table class="w-full">
                    <tbody>
                    <tr>
                        <td valign="top">
                            1x
                        </td>
                        <td>
                            <p class="text-[16px] font-bold">Hasan Piker</p>
                            <p class="text-[15px] ">16 septembre 2023 - 18h00-19h00</p>
                        </td>
                        <td valign="top" class="text-center font-bold text-[16px]">
                            65$
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr class="border-b border-[#D6D6D6]">
                        <td colspan="2" class="pt-[53px] pb-[24px]">
                            Sous-total
                        </td>
                        <td class="pt-[53px] text-center font-bold text-[16px] pb-[24px]">
                            65$
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="pt-[24px]">
                            Taxe (TPS)
                        </td>
                        <td class="pt-[24px] text-center font-bold text-[16px] ">
                            3,25$
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="pt-[24px]">
                            Taxe (TVQ)
                        </td>
                        <td class="text-center font-bold text-[16px] pt-[24px]">
                            6,48$
                        </td>
                    </tr>
                    <tr class="border-b border-[#D6D6D6]">
                        <td colspan="2" class="pt-[24px] font-bold pb-[13px]">
                            Total
                        </td>
                        <td class="text-center font-bold text-[16px] pt-[24px] pb-[13px]">
                            74,73$
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="pt-[35px]">
                            <x-button theme="gradient" class="block w-full text-white">Passez à la caisse</x-button>
                        </td>

                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
</div>
