@props(['activeTab' => 0, 'tabs'])

<div x-data="{ activeTab: {{$activeTab}} }">
    <div class="flex space-x-12">
        @foreach ($tabs as $index => $tab)
			<button
					x-text="{{ json_encode($tab['label']) }}"
					@click="activeTab = {{ $index }}"
					:class="activeTab === {{ $index }} ? 'text-[#5377DD] border-[#5377DD]' : 'text-[#9CA8C9] border-[#D0D9F0]'"
					class="flex-1 pb-2 transition font-semibold border-b-2 text-left"
			></button>
		@endforeach
    </div>

    <div class="mt-8">
        {{ $slot }}
    </div>
</div>


