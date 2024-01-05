<div>
  {{-- label --}}
  @if(!!$label)<x-label for="{{ $id }}" label="{{ $label }}" />@endif

  {{-- textarea --}}
  <div class="mt-2">
    <textarea
      rows="{{ $rows }}"
      name="{{ $name }}"
      id="{{ $id }}"
      placeholder="{{ $placeholder }}"
      @class([
        "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
    ])
    @isset($description) aria-describedby="{{ $id }}-description" @endisset
    @error($name) aria-invalid="true" aria-describedby="{{ $id }}-error" @enderror
    ></textarea>
  </div>
</div>
