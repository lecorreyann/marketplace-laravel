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
        message="{{ session()->has('error.message') ? session('error.message') : session('error') }}"
        class="mt-2"
      />
    @endif

  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form class="space-y-6" wire:submit="store">


        {{-- user.fist_name --}}
        <x-forms.fields.input
          label="First name"
          name="first_name"
          id="first_name"
          type="text"
          autocomplete="given-name"
          placeholder="John"
        />

        {{-- user.last_name --}}
        <x-forms.fields.input
          label="Last name"
          name="last_name"
          id="last_name"
          type="text"
          autocomplete="family-name"
          placeholder="Doe"
        />

        {{-- user.email --}}
        <x-forms.fields.input
          label="Email"
          name="email"
          id="email"
          type="email"
          autocomplete="email"
          placeholder="john@doe.com"
        />

        {{-- user.password --}}
        <x-forms.fields.input
          label="Password"
          name="password"
          id="password"
          type="password"
          autocomplete="new-password"
        />

        {{-- user.password_confirmation --}}
        <x-forms.fields.input
          label="Confirm password"
          name="password_confirmation"
          id="password_confirmation"
          type="password"
          autocomplete="new-password"
        />

        {{-- user.terms --}}


        <div>
          <x-button type="submit" class="flex w-full leading-6 justify-center">Create account</x-button>
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