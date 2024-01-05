<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">

  @if(session()->has('success') || session()->has('success.title') || session()->has('success.message'))
    <x-session />

  @else

    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create your account</h2>

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

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form class="space-y-6" wire:submit="register">


        {{-- user.fist_name --}}
        <x-input
          label="First name"
          name="first_name"
          id="first_name"
          type="text"
          autocomplete="given-name"
          placeholder="John"
        />

        {{-- user.last_name --}}
        <x-input
          label="Last name"
          name="last_name"
          id="last_name"
          type="text"
          autocomplete="family-name"
          placeholder="Doe"
        />

        {{-- user.email --}}
        <x-input
          label="Email"
          name="email"
          id="email"
          type="email"
          autocomplete="email"
          placeholder="john@doe.com"
        />

        {{-- user.password --}}
        <x-input
          label="Password"
          name="password"
          id="password"
          type="password"
          autocomplete="new-password"
        />

        {{-- user.password_confirmation --}}
        <x-input
          label="Confirm password"
          name="password_confirmation"
          id="password_confirmation"
          type="password"
          autocomplete="new-password"
        />

        {{-- user.terms --}}


        <div>
          <x-button type="submit" class="relative flex w-full leading-6 justify-center">
            Create account
            <div wire:loading.flex class="flex absolute top-0 right-0 bottom-0 items-center pr-4">
              <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </div>
          </x-button>
        </div>
      </form>

    </div>

    <p class="mt-10 text-center text-sm text-gray-500">
      Already have an account?
      <a href="{{ route('auth.sign_in.index') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign In</a>
    </p>
  </div>

  @endif
</div>
