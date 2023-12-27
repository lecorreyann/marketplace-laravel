<x-layouts.auth-layout>
    <div class="container mx-auto">
        <div>
            @if (session('success'))
                <div>
                    <x-alert type="success" :content="session('success')" />
                </div>
            @else
                <form action="{{ route('auth.sign_in.store') }}" method="post">
                    @csrf
                    {{-- user.email --}}
                    <x-forms.input type="email" name="email" label="Email"
                        value="{{ old('email', app()->environment('local') ? env('DEMO_EMAIL') : '') }}" required="true"
                        autocomplete="email" />
                    {{-- user.password --}}
                    <x-forms.input type="password" name="password" label="Password" required="true"
                        value="{{ app()->environment('local') ? env('DEMO_PASSWORD') : '' }}" />
                    {{-- forgot password --}}
                    <div class="mt-1">
                        <a href="{{ route('auth.forgot_password.index') }}"
                            class="font-semibold text-indigo-600 hover:text-indigo-500 text-sm">Forgot
                            password?</a>
                    </div>
                    {{-- remember me --}}
                    <div class="mt-6 text-center"><x-buttons.submit text="Sign In" size="xl" type="primary" />
                    </div>
                </form>

                @if ($errors->first('email') === 'The email address is not verified.')
                    <form action="{{ route('auth.verify_email.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email') }}">
                        <p class="mt-10 text-center text-sm text-gray-500">
                            If you did not receive the email, please check your spam folder or
                            <button type="submit"
                                class="rounded bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100">click
                                here
                                to resend</button>
                        </p>
                    </form>
                @endif
            @endif
        </div>
    </div>
</x-layouts.auth-layout>
