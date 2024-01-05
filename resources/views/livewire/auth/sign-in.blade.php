<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">

  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">

  @if(session()->has('success') || session()->has('success.title') || session()->has('success.message'))
    <x-session />

  @else

    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Log in to your account</h2>

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
      <form class="space-y-6" wire:submit="signIn">


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
          autocomplete="current-password"
        />

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input wire:model="form.remember" id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
            <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-900">Remember me</label>
          </div>

          <div class="text-sm leading-6">
            <a href="{{ route('auth.forgot_password.index') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
          </div>
        </div>

        <div>
          <x-button type="submit" class="flex w-full leading-6 justify-center">Log in</x-button>
        </div>
      </form>
    </div>

    <p class="mt-10 text-center text-sm text-gray-500">
      Don't have an account?
      <a href="{{ route('auth.sign_up.index') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign Up</a>
    </p>
  </div>

  @endif
</div>
