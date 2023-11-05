<section>
    <div class="mx-auto max-w-[1440px] mt-[70px] mb-[25px]">
        <ul class="flex">
            <li>
                <a href="{{route('home')}}">Fan2Friend</a> &nbsp; / &nbsp;
            </li>
            <li>
                <a href="{{route('celebrity.index')}}">Personnalités</a> &nbsp; / &nbsp;
            </li>
            <li>
                <a href="{{route('celebrity.index', ['category' => $celebrity->category->slug])}}">
                    {{$celebrity->category->name}}
                </a>
                &nbsp; / &nbsp;
            </li>
            <li>
                <a  class="text-primary-red">{{$celebrity->fullName}}</a>
            </li>
        </ul>
    </div>
</section>
