<div x-data="{ open: false }" {{$attributes}}>
    <div class="relative">
        <label for="search" class="sr-only">Search</label>
        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                          d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input id="search"
                   wire:model.live="search"
                   x-on:click="open = true"
                   x-on:click.away="open = false"
                   class="hidden lg:block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
                   placeholder="SearchCelebrities" type="search">
        </div>
        <ul x-show="open"
            class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            role="listbox">
            @if($celebrities->isEmpty() && $search != "")
                <li class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" role="option"
                    tabindex="-1" aria-selected="false">
                    <div class="flex items-center">
                            <span
                                class="truncate">No matching result was found.</span>
                    </div>
                </li>

            @else
                @foreach($celebrities as $celebrity)
                    <li class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900" role="option"
                        tabindex="-1" aria-selected="false">
                        <a class="flex items-center"
                           href="{{route('celebrity.show', ['category' => $celebrity->category->slug, 'celebrity' => $celebrity->slug])}}">
                            <img
                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                                alt="" class="h-6 w-6 flex-shrink-0 rounded-full">
                            <span
                                class="ml-3 truncate"> {{$celebrity->name}}</span>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
