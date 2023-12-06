@props([
    'title' => '',
    'description' => '',
    'buttonLink' => '',
    'buttonText' => '',
    'imageUrl' => ''
])

<section>
    <div class="mx-auto max-w-[1440px] lg:grid lg:grid-cols-12 relative">
        <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-[70px] lg:py-[93px] xl:col-span-6 gradient-to-98">
            <div class="mx-auto max-w-2xl lg:mx-0">
                @empty(!$title)
                    <h1 class="h1 text-white">{{ $title }}</h1>
                @endempty
                @empty(!$description)
                    <p class="mt-6 p text-white">{{ $description }}</p>
                @endempty

                @empty(!$buttonText && !$buttonLink)
                    <div class="mt-10 flex items-center gap-x-6">
                        <x-button href="{{ $buttonLink }}">{{ $buttonText }}</x-button>
                    </div>
                @endempty
            </div>
        </div>
        @empty(!$imageUrl)
            <!-- Image Section -->
            <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0 lg:pr-8">
                <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
                     src="{{ $imageUrl }}" alt="">
            </div>
        @endempty
    </div>
</section>
