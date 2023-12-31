@if(! $multiple)
  <select {{ $controlAttributes() }}>
    @if(! empty($options))
      @foreach($options as $v => $l)
        @if($placeholder)
          <option value hidden>{{ $placeholder }}</option>
        @endif
        <option {{ $isSelected($v) ? 'selected' : '' }} value="{{ $v }}">{{ $l }}</option>
      @endforeach
    @else
      {{ $slot }}
    @endif
  </select>
@else
  <div id="{{ $id }}" {{ $controlAttributes() }}>
    @if(! empty($options))
      @foreach($options as $v => $l)
        <x-form.label for="{{ $name }}_{{ $loop->iteration }}" class="flex items-center space-x-2 w-full py-2 px-3 bg-white hover:bg-gray-50">
          <x-form.checkbox name="{{ $name }}" id="{{ $name }}_{{ $loop->iteration }}" value="{{ $v }}" :checked="$isSelected($v)" />
          <span>{{ $l }}</span>
        </x-form.label>
      @endforeach
    @else
      {{ $slot }}
    @endif
  </div>
@endif
