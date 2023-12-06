<span class="isolate inline-flex rounded-md shadow-sm w-full gap-x-3" wire:ignore:self>
  <x-button type="button"
            class="flex-1"
            theme="gradient"
            wire:click="fillUserByRole('admin')">
      Admin
  </x-button>
  <x-button type="button"
            class="flex-1"
            theme="gradient"

            wire:click="fillUserByRole('celebrity')">
      Celebrity
  </x-button>
  <x-button type="button"
            class="flex-1"
            theme="gradient"

            wire:click="fillUserByRole('customer')">
      Customer
    </x-button>
</span>
