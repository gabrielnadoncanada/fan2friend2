@if(isset($breadcrumbs) && count($breadcrumbs) > 0)
    <section>
        <div class="mx-auto max-w-[1440px] mt-[70px] mb-[25px]">
            <ul class="flex">
                @foreach($breadcrumbs as $breadcrumb)
                    <li>
                        @if(!$loop->last)
                            <a class="capitalize" href="{{ route($breadcrumb['route'], $breadcrumb['params'] ?? []) }}">
                                {{ $breadcrumb['label'] }}
                            </a> &nbsp; / &nbsp;
                        @else
                            <a class="text-primary-red">
                                {{ $breadcrumb['label'] }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
