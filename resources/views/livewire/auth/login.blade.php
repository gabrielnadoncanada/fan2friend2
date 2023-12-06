<div class="pt-[85px]">
    <div class="container mx-auto w-[475px] my-[140px] leading-[1]">
        <h1 class="text-[36px] font-bold text-dark text-center mb-5">{{__('app.login.title')}}</h1>
        <x-form wire:submit.prevent="login" class="flex flex-col gap-y-6 sm:gap-y-12">
            <div>
                <x-form.field>
                    <x-form.label for="email" :value="__('app.register.email')"/>
                    <x-form.error for="email"/>
                    <x-form.input
                        :placeholder="__('app.register.email_placeholder')"
                        wire:model="email" id="email" type="text" name="email"></x-form.input>
                </x-form.field>
                <x-form.field x-data="{ show: false }">
                    <div class="flex">
                        <x-form.label for="password" :value="__('app.register.password')"/>
                        <x-button href="{{route('forgot-password')}}" class="ml-auto text-sm font-medium text-primary"
                                  type="button" theme="ghost">
                            <strong>{{ __('Forgot your password?') }}</strong>
                        </x-button>
                    </div>
                    <x-form.error for="password"/>
                    <div class="flex relative items-center">
                        <x-form.input class="pr-[35px]" wire:model="password" id="password"
                                      x-bind:type="show ? 'text' : 'password'" name="password"></x-form.input>
                        <button class="absolute right-[15px] " @click.prevent="show = !show" type="button">
                            <img x-show="show" src="{{asset('svg/eye-open.svg')}}" alt="">
                            <img x-show="!show" src="{{asset('svg/eye-closed.svg')}}" alt="">
                        </button>
                    </div>

                </x-form.field>
                <x-form.field class="space-y-0 mt-1 flex items-center gap-x-3">
                    <x-form.checkbox id="remember_me" class="mt-2 mb-[2px]" name="remember_me"></x-form.checkbox>
                    <x-form.label for="remember_me" :value="__('Remember me')"/>
                </x-form.field>
            </div>
            <div class="flex flex-col text-center sm:-mt-6">
                <x-button theme="gradient">{{ __('app.home.call_to_action_3') }}</x-button>
                <p class="mt-6 text-primary ">{{ __('You have no account?') }}
                    <x-button href="{{route('register')}}" type="button" theme="ghost">
                        <strong>{{ __('Create account') }}</strong>
                    </x-button>
                </p>
            </div>
        </x-form>
    </div>
</div>
