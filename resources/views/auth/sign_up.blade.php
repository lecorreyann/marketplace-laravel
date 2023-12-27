<x-layouts.auth-layout>
    <div class="container mx-auto">
        <div>
            @if (session('success'))
                <div>
                    <x-alert type="success" :content="session('success')" />
                </div>
            @else
                <form action="{{ route('auth.sign_up.store') }}" method="post">
                    @csrf
                    {{-- user.first_name --}}
                    <x-forms.input type="text" name="first_name" label="First name"
                        value="{{ old('first_name', app()->environment('local') ? env('DEMO_FIRST_NAME') : '') }}"
                        required="true" />
                    {{-- user.last_name --}}
                    <x-forms.input type="text" name="last_name" label="Last name"
                        value="{{ old('last_name', app()->environment('local') ? env('DEMO_LAST_NAME') : '') }}"
                        required="true" />
                    {{-- user.email --}}
                    <x-forms.input type="email" name="email" label="Email"
                        value="{{ old('email', app()->environment('local') ? env('DEMO_EMAIL') : '') }}"
                        required="true" />
                    {{-- user.password --}}
                    <x-forms.input type="password" name="password" label="Password" required="true"
                        value="{{ app()->environment('local') ? env('DEMO_PASSWORD') : '' }}" />
                    {{-- user.password confirmed --}}
                    <x-forms.input type="password" name="password_confirmation" label="Password confirmation"
                        required="true" value="{{ app()->environment('local') ? env('DEMO_PASSWORD') : '' }}" />

                    <div class="mt-6 text-center">
                        <div class="mt-6"><x-buttons.submit text="Sign Up" size="xl" type="primary" /></div>
                    </div>

                </form>
            @endif
        </div>
    </div>
</x-layouts.auth-layout>
