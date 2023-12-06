<div class="pt-[85px]">
    <div class="container mx-auto w-[475px] my-[140px] leading-[1]">
        <h1 class="text-[36px] font-bold text-dark text-center mb-5">{{__('app.forgot-password.title')}}</h1>
        <p class="mb-6 leading-[1.5]">
            {{ $status ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
        </p>
        @if (!$status)
            {{ $status }}
            <x-form wire:submit.prevent="sendResetLink" class="flex flex-col gap-y-6 sm:gap-y-12">
                <x-form.field>
                    <x-form.label for="email" :value="__('Email')" />
                    <x-form.error for="email" />
                    <x-form.input wire:model="email" id="email" type="email" name="email"></x-form.input>
                </x-form.field>

                <div class="flex flex-col text-center sm:-mt-6">
                    <x-button theme="gradient">{{ __('app.home.call_to_action_4') }}</x-button>
                </div>
            </x-form>
        @endif
    </div>
</div>






