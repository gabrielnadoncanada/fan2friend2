@props(['index'])

<div x-show="activeTab === {{ $index }}" class="">
    {{ $slot }}
</div>
