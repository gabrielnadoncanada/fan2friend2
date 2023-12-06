<div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-24 py-48">
        <div class="mx-auto max-w-4xl divide-y divide-gray-900/10">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Frequently asked questions</h2>
                <p class="mt-4 text-lg leading-8 text-gray-600">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate aliquid ad id doloremque
                </p>
            </div>

            <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
                <div x-data="{ open: true }" class="pt-6">
                    <dt>
                        <button type="button" x-description="Expand/collapse question button"
                                class="flex w-full items-start justify-between text-left text-gray-900"
                                aria-controls="faq-0" @click="open = !open" aria-expanded="true"
                                x-bind:aria-expanded="open.toString()">
                                <span
                                    class="text-base font-semibold leading-7">What's the best thing about Switzerland?</span>
                            <span class="ml-6 flex h-7 items-center">
                    <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6 hidden" :class="{ 'hidden': open }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
                    <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
                  </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-0" x-show="open">
                        <p class="text-base leading-7 text-gray-600">I don't know, but the flag is a big plus. Lorem
                            ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam
                            fugiat.</p>
                    </dd>
                </div>
                <div x-data="{ open: false }" class="pt-6">
                    <dt>
                        <button type="button" x-description="Expand/collapse question button"
                                class="flex w-full items-start justify-between text-left text-gray-900"
                                aria-controls="faq-1" @click="open = !open" aria-expanded="false"
                                x-bind:aria-expanded="open.toString()">
                            <span class="text-base font-semibold leading-7">How do you make holy water?</span>
                            <span class="ml-6 flex h-7 items-center">
                    <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': open }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
                    <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="hidden h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
                  </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-1" x-show="open" style="display: none;">
                        <p class="text-base leading-7 text-gray-600">You boil the hell out of it. Lorem ipsum dolor
                            sit amet consectetur adipisicing elit. Magnam aut tempora vitae odio inventore fuga
                            aliquam nostrum quod porro. Delectus quia facere id sequi expedita natus.</p>
                    </dd>
                </div>
                <div x-data="{ open: false }" class="pt-6">
                    <dt>
                        <button type="button" x-description="Expand/collapse question button"
                                class="flex w-full items-start justify-between text-left text-gray-900"
                                aria-controls="faq-2" @click="open = !open" aria-expanded="false"
                                x-bind:aria-expanded="open.toString()">
                            <span class="text-base font-semibold leading-7">What do you call someone with no body and no nose?</span>
                            <span class="ml-6 flex h-7 items-center">
                    <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': open }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
                    <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="hidden h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
                  </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-2" x-show="open" style="display: none;">
                        <p class="text-base leading-7 text-gray-600">Nobody knows. Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Culpa, voluptas ipsa quia excepturi, quibusdam natus
                            exercitationem sapiente tempore labore voluptatem.</p>
                    </dd>
                </div>
                <div x-data="{ open: false }" class="pt-6">
                    <dt>
                        <button type="button" x-description="Expand/collapse question button"
                                class="flex w-full items-start justify-between text-left text-gray-900"
                                aria-controls="faq-3" @click="open = !open" aria-expanded="false"
                                x-bind:aria-expanded="open.toString()">
                        <span
                            class="text-base font-semibold leading-7">Why do you never see elephants hiding in trees?</span>
                            <span class="ml-6 flex h-7 items-center">
                    <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': open }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
                    <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="hidden h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
                  </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-3" x-show="open" style="display: none;">
                        <p class="text-base leading-7 text-gray-600">Because they're so good at it. Lorem ipsum
                            dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.</p>
                    </dd>
                </div>
                <div x-data="{ open: false }" class="pt-6">
                    <dt>
                        <button type="button" x-description="Expand/collapse question button"
                                class="flex w-full items-start justify-between text-left text-gray-900"
                                aria-controls="faq-4" @click="open = !open" aria-expanded="false"
                                x-bind:aria-expanded="open.toString()">
                            <span class="text-base font-semibold leading-7">Why can't you hear a pterodactyl go to the bathroom?</span>
                            <span class="ml-6 flex h-7 items-center">
                    <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': open }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
                    <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="hidden h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
                  </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-4" x-show="open" style="display: none;">
                        <p class="text-base leading-7 text-gray-600">Because the pee is silent. Lorem ipsum dolor
                            sit amet, consectetur adipisicing elit. Ipsam, quas voluptatibus ex culpa ipsum,
                            aspernatur blanditiis fugiat ullam magnam suscipit deserunt illum natus facilis atque
                            vero consequatur! Quisquam, debitis error.</p>
                    </dd>
                </div>
                <div x-data="{ open: false }" class="pt-6">
                    <dt>
                        <button type="button" x-description="Expand/collapse question button"
                                class="flex w-full items-start justify-between text-left text-gray-900"
                                aria-controls="faq-5" @click="open = !open" aria-expanded="false"
                                x-bind:aria-expanded="open.toString()">
                            <span class="text-base font-semibold leading-7">Why did the invisible man turn down the job offer?</span>
                            <span class="ml-6 flex h-7 items-center">
                    <svg x-description="Icon when question is collapsed." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="h-6 w-6" :class="{ 'hidden': open }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
</svg>
                    <svg x-description="Icon when question is expanded." x-state:on="Item expanded"
                         x-state:off="Item collapsed" class="hidden h-6 w-6" :class="{ 'hidden': !(open) }" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6"></path>
</svg>
                  </span>
                        </button>
                    </dt>
                    <dd class="mt-2 pr-12" id="faq-5" x-show="open" style="display: none;">
                        <p class="text-base leading-7 text-gray-600">He couldn't see himself doing it. Lorem ipsum
                            dolor sit, amet consectetur adipisicing elit. Eveniet perspiciatis officiis corrupti
                            tenetur. Temporibus ut voluptatibus, perferendis sed unde rerum deserunt eius.</p>
                    </dd>
                </div>

            </dl>
        </div>
    </div>
    @include('sections.partners')
    @include('sections.footer')
</div>




