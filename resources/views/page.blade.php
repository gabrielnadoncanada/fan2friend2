<x-app-layout>
    @include('pages.'.app()->getLocale().'.'.$page)
    {{--    @include('sections.partners') --}}
    @include('sections.footer')
</x-app-layout>

