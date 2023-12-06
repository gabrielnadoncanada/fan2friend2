@props(['show' => false])

<x-modal :show="$show" id="reset-password" title="Réinitialiser le mot de passe">
    <x-form wire:submit.prevent="resetPassword" class="flex flex-col gap-y-6 sm:gap-y-12">
        <x-form.input type="hidden" name="token" wire:model="token" value="{{ $token }}"></x-form.input>
        <div>
            <x-form.input wire:model="email" id="email" type="hidden" name="email" :value="$email"></x-form.input>
            <x-form.field>
                <x-form.label for="password" :value="__('Password')"/>
                <x-form.error for="password"/>
                <x-form.input wire:model="password" id="password" type="password" name="password"
                              autocomplete="off"></x-form.input>
            </x-form.field>
            <x-form.field>
                <x-form.label for="password_confirmation" :value="__('Confirm Password')"/>
                <x-form.error for="password_confirmation"/>
                <x-form.input wire:model="password_confirmation" id="password_confirmation" type="password"
                              name="password_confirmation"></x-form.input>
            </x-form.field>
        </div>
        <div class="flex flex-col text-center sm:-mt-6">
            <x-button theme="gradient"> {{ __('Reset Password') }}</x-button>
        </div>
    </x-form>
</x-modal>
