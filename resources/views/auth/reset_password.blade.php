<x-layouts.auth-layout>
    <div class="container mx-auto">
        <div>
            @if (session('success'))
                <div>
                    <x-alert type="success" :content="session('success')" />
                </div>
            @else
                <form
                    action="{{ route('auth.reset_password.update', ['password_reset_token' => request()->query('password_reset_token')]) }}"
                    method="post">
                    @csrf
                    @method('PATCH')
                    {{-- user.password --}}
                    <x-forms.input type="password" name="password" label="Password" required="true"
                        value="{{ app()->environment('local') ? env('DEMO_PASSWORD') : '' }}" />
                    {{-- user.password confirmed --}}
                    <x-forms.input type="password" name="password_confirmation" label="Password confirmation"
                        required="true" value="{{ app()->environment('local') ? env('DEMO_PASSWORD') : '' }}" />

                    <div class="mt-6"><x-buttons.submit text="Reset Password" /></div>
                </form>
            @endif
        </div>
        <div>
            {{-- sign up --}}
            <a href="{{ route('auth.sign_up.index') }}">Sign Up</a>
            {{-- sign in --}}
            <a href="{{ route('auth.sign_in.index') }}">Sign In</a>
        </div>
    </div>
</x-layouts.auth-layout>
