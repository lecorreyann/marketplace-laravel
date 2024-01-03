<div @class([
  "sm:mx-auto sm:w-full sm:max-w-xl",
  $attributes->get('class') ??  null => $attributes->get('class'),
])>
  {{-- success --}}
  @if(session()->has('success.title'))
    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ session('success.title') }}</h2>
  @endif

  @if(session()->has('success.message'))
    <p class="mt-6 text-base leading-7 text-gray-600">{{ session('success.message') }}</p>
  @elseif(session()->has('success'))
    <p class="mt-6 text-base leading-7 text-gray-600">{{ session('success') }}</p>
  @endif

  {{-- error --}}
  @if(session()->has('error.title'))
    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ session('error.title') }}</h2>
  @endif

  @if(session()->has('error.message'))
    <p class="mt-6 text-base leading-7 text-gray-600">{{ session('error.message') }}</p>
  @elseif(session()->has('error'))
    <p class="mt-6 text-base leading-7 text-gray-600">{{ session('error') }}</p>
  @endif
</div>
