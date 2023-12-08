<div class="">
    <div class="container mx-auto w-[475px] my-[140px] leading-[1]">
        <h1 class="text-[36px] font-bold text-dark text-center mb-5">{{__('app.register.title')}}</h1>
        <x-form wire:submit.prevent="register" class="flex flex-col gap-y-6 sm:gap-y-12">
            <div>
                <x-form.field>
                    <x-form.label for="first_name" :value="__('app.register.first_name')" />
                    <x-form.error for="first_name" />
                    <x-form.input wire:model="firstName" id="first_name" type="text" name="first_name"></x-form.input>
                </x-form.field>
                <x-form.field>
                    <x-form.label for="last_name" :value="__('app.register.last_name')" />
                    <x-form.error for="last_name" />
                    <x-form.input wire:model="lastName" id="last_name" type="text" name="last_name"></x-form.input>
                </x-form.field>
                <x-form.field>
                    <x-form.label for="email" :value="__('app.register.email')" />
                    <x-form.error for="email" />
                    <x-form.input wire:model="email" id="email" type="email" name="email"></x-form.input>
                </x-form.field>
{{--                <x-form.field x-data="{ show: false }">--}}
{{--                    <div class="flex">--}}
{{--                        <x-form.label for="password" :value="__('app.register.password')" />--}}
{{--                    </div>--}}
{{--                    <x-form.error for="password" />--}}
{{--                    <div class="flex relative items-center">--}}
{{--                        <x-form.input class="pr-[35px]" wire:model="password" id="password"--}}
{{--                                      x-bind:type="show ? 'text' : 'password'" name="password"></x-form.input>--}}
{{--                        <button class="absolute right-[15px] " @click.prevent="show = !show" type="button">--}}
{{--                            <img x-show="show" src="{{ asset('svg/eye-open.svg') }}" alt="">--}}
{{--                            <img x-show="!show" src="{{ asset('svg/eye-closed.svg') }}" alt="">--}}
{{--                        </button>--}}
{{--                    </div>--}}

{{--                </x-form.field>--}}
{{--                <x-form.field>--}}
{{--                    <x-form.label for="password_confirmation" :value="__('app.register.password_confirmation')" />--}}
{{--                    <x-form.error for="password_confirmation" />--}}
{{--                    <x-form.input wire:model="password_confirmation" id="password_confirmation" type="password"--}}
{{--                                  name="password_confirmation"></x-form.input>--}}
{{--                </x-form.field>--}}
            </div>
            <div class="flex flex-col text-center sm:-mt-6">
                <x-button theme="gradient">{{ __('app.home.call_to_action_2') }}</x-button>
{{--                <p class="mt-6 text-primary ">{{ __('app.register.already_have_account') }}--}}
{{--                    <x-button type="button" theme="ghost"  href="{{route('login')}}">--}}
{{--                        <strong>{{ __('app.register.login') }}</strong>--}}
{{--                    </x-button>--}}
{{--                </p>--}}
            </div>
        </x-form>
    </div>
</div>
