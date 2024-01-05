<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto sm:w-full sm:max-w-md">

  @if(session()->has('success') || session()->has('success.title') || session()->has('success.message'))
    <x-session />

  @else

    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">What do you offer?</h2>

    @if(session()->has('error') || session()->has('error.title') || session()->has('error.message'))
      <x-alert
        alert-type="danger"
        title="{{ session()->has('error.title') ? session('error.title') : null }}"
        class="mt-2"
      >
        {{ session()->has('error.message') ? session('error.message') : session('error') }}
      </x-alert>
    @endif

  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[720px]">
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form class="space-y-6" wire:submit="store">


        {{-- item.name --}}
        <x-input
          label="Name"
          name="name"
          id="name"
          type="text"
          placeholder="Playstation 5"
        />

        {{-- item.description --}}
        <x-textarea
          label="Description"
          name="description"
          id="description"
          placeholder="This is a description"
        />

        <div>
          <x-button type="submit" class="flex w-full leading-6 justify-center">Publish</x-button>
        </div>
      </form>
    </div>

  </div>

  @endif
</div>
