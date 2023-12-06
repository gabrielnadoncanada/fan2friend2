<div class="mx-auto max-w-2xl px-4 lg:max-w-none lg:px-0">
    <div>
        <x-text as="h2" theme="h3">{{__('app.checkout.paymentTitle')}}</x-text>
        <h3 id="contact-info-heading"
            class="text-lg font-medium text-gray-900">

        </h3>
        <div class="mt-[30px] grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
            <div>
                <x-form.label for="firstName" required="true">
                    {{__('app.checkout.fields.firstName')}}
                </x-form.label>
                <label for="firstName" class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1">
                    <x-form.input type="text" id="firstName" name="firstName" wire:model="firstName"
                                  autocomplete="given-name"></x-form.input>
                </div>
                <x-form.error for="firstName"/>
            </div>
            <div>
                <x-form.label for="lastName"> {{__('app.checkout.fields.lastName')}}</x-form.label>
                <label for="lastName" class="block text-sm font-medium text-gray-700"></label>
                <div class="mt-1">
                    <x-form.input type="text" id="lastName" name="lastName" wire:model="lastName"
                                  autocomplete="family-name"></x-form.input>
                </div>
                <x-form.error for="lastName"/>
            </div>
            <div>
                <x-form.label for="company">{{__('app.checkout.fields.company')}}</x-form.label>
                <div class="mt-1">
                    <x-form.input type="text" name="company" id="company"
                                  wire:model="company"
                                  autocomplete="organization"
                    />
                </div>
                <x-form.error for="company"/>
            </div>
            <div>
                <x-form.label for="phone">{{__('app.checkout.fields.phone')}}</x-form.label>
                <div class="mt-1">
                    <x-form.input type="tel" name="phone" id="phone" autocomplete="tel-national"
                                  wire:model="phone"
                                  placeholder="{{__('app.checkout.fields.phonePlaceholder')}}"/>
                </div>
                <x-form.error for="phone"/>
            </div>
            <div>
                <x-form.label for="address1">{{__('app.checkout.fields.address1')}}</x-form.label>
                <div class="mt-1">
                    <x-form.input type="text" name="address1" id="address1"
                                  wire:model="address1"
                                  placeholder="{{__('app.checkout.fields.address1')}}"
                                  autocomplete="address-line1"/>
                </div>
                <x-form.error for="address1"/>
            </div>
            <div>
                <x-form.label for="city">{{__('app.checkout.fields.city')}}</x-form.label>
                <div class="mt-1">
                    <x-form.input type="text" name="city" id="city" autocomplete="address-level2"
                                  wire:model="city"
                    />
                </div>
                <x-form.error for="city"/>
            </div>
            <div>
                <x-form.label for="address2">{{__('app.checkout.fields.address2')}}</x-form.label>
                <div class="mt-1">
                    <x-form.input type="text" name="address2" id="address2" autocomplete="address-line2"
                                  wire:model="address2"
                                  placeholder="{{__('app.checkout.fields.address2Placeholder')}}"/>
                </div>
                <x-form.error for="address2"/>
            </div>
            <div>
                <x-form.label for="postalCode">{{__('app.checkout.fields.postalCode')}}</x-form.label>
                <div class="mt-1">
                    <x-form.input type="text" name="postalCode" id="postalCode"
                                  wire:model="postalCode"
                                  placeholder="{{__('app.checkout.fields.postalCodePlaceholder')}}"
                                  autocomplete="postal-code"/>
                </div>
                <x-form.error for="postalCode"/>
            </div>
            <div>
                <x-form.label for="state">{{__('app.checkout.fields.state')}}</x-form.label>
                <div class="mt-1">
                    <x-form.select id="state" name="state" autocomplete="address-level1"
                                   wire:model.live="state"
                    >
                        <option value="">{{__('app.checkout.selectOption')}}</option>
                        @php
                            $options = (collect(App\Enums\CanadianProvince::cases())->mapWithKeys(fn ($case) => [
                                ($case?->value ?? $case->name) => $case->getLabel() ?? $case->name])->all());
                        @endphp
                        @foreach($options as $key => $option)
                            <option value="{{$key}}">{{$option}}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <x-form.error for="state"/>
            </div>
            <div>
                <x-form.label for="country">{{__('app.checkout.fields.country')}}</x-form.label>
                <div class="mt-1">
                    <x-form.select id="country" name="country" autocomplete="country-name"
                                   wire:model="country">
                        <option value="">{{__('app.checkout.selectOption')}}</option>
                        @foreach(\App\Enums\Country::values() as $key => $country)
                            <option value="{{$key}}">{{$country}}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <x-form.error for="country"/>
            </div>

            @if(auth()->guest())
                <div>
                    <x-form.label for="email">{{__('app.checkout.fields.email')}}</x-form.label>
                    <div class="mt-1">
                        <x-form.input type="text" id="email" name="email"
                                      wire:model="email"
                                      autocomplete="email"></x-form.input>
                    </div>
                    <x-form.error for="email"/>
                </div>
                <div>
                    <x-form.label for="password">{{__('app.checkout.fields.password')}}</x-form.label>
                    <div class="mt-1">
                        <x-form.input type="password" id="password" name="password"
                                      autocomplete="new-password"
                                      wire:model="password"
                        ></x-form.input>
                        <span class="block mt-2 text-dark-gray-2 text-[12px] px-[30px] leading-[16px]">
                            {{__('app.checkout.fields.passwordDescription')}}
                        </span>
                    </div>
                    <x-form.error for="password"/>
                </div>
            @endif
        </div>
    </div>
</div>

