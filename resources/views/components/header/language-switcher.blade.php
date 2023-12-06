<select wire:change="switchLocale()" wire:model="locale" class="border-0 uppercase py-0 ">
    @foreach(config('app.available_locales') as $locale)
        <option {{session('locale') === $locale ? 'selected' : ''}} value="{{$locale}}">{{$locale}}</option>
    @endforeach
</select>


