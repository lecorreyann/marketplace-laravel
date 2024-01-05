<div @class([
  $attributes->get('class') ??  null => $attributes->get('class'),
])>

  {{-- label --}}
  @if(!!$label)<x-label for="{{ $id }}" label="{{ $label }}" />@endif

  {{-- input --}}
  <div class="relative mt-2 rounded-md shadow-sm">
    <input
      type="{{ $type }}"
      name="{{ $name }}"
      id="{{ $id }}"
      value="{{ old($name, isset($value) ? $value : '') }}"
      wire:model="{{ $name }}"
      @isset($autocomplete) autocomplete="{{ !!$autocomplete ? $autocomplete : null }}" @endisset
      placeholder="{{ $placeholder }}"
      @class([
        "block w-full rounded-md border-0 py-1.5 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6",
        "text-gray-900 shadow-sm ring-gray-300 placeholder:text-gray-400  focus:ring-indigo-600" => !$errors->has($name),
        "pr-10 text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500" => $errors->has($name)
        ])
      @isset($description) aria-describedby="{{ $id }}-description" @endisset
      @error($name) aria-invalid="true" aria-describedby="{{ $id }}-error" @enderror
    />

    @error($name)
      {{-- error icon --}}
      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>
      </div>
    @enderror

  </div>

  @if(!$errors->has($name) && isset($description))
    {{-- description --}}
    <p class="mt-2 text-sm text-gray-500" id="{{ $id }}-description">{{ $description }}</p>
  @endif

  @error($name)
    {{-- error message --}}
    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
  @enderror

</div>
