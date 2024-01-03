<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">

  @if(session()->has('success') || session()->has('success.title') || session()->has('success.message'))
    <x-session />

  @else

    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Get link to reset your password</h2>

    @if(session()->has('error') || session()->has('error.title') || session()->has('error.message'))
      <x-alert
        alert-type="danger"
        title="{{ session()->has('error.title') ? session('error.title') : null }}"
        message="{{ session()->has('error.message') ? session('error.message') : session('error') }}"
        class="mt-2"
      />
    @endif

  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form class="space-y-6" wire:submit="store">


        {{-- user.email --}}
        <x-forms.fields.input
          label="Email"
          name="email"
          id="email"
          type="email"
          autocomplete="email"
          placeholder="john@doe.com"
        />


        <div>
          <x-button type="submit" class="flex w-full leading-6 justify-center">Forgot password</x-button>
        </div>
      </form>
    </div>


  </div>

  @endif
</div>
