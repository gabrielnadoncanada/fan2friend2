<select
    {{$attributes->class(['border-0 uppercase py-0 pl-0 bg-transparent'])}}
    wire:change="switchLocale()" wire:model="locale" >
    @foreach(config('app.available_locales') as $locale)
        <option {{session('locale') === $locale ? 'selected' : ''}} value="{{$locale}}">{{$locale}}</option>
    @endforeach
</select>


