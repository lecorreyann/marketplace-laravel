<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('auth.forgot_password.store') }}" method="post">
            @csrf
            {{-- user.email --}}
            <x-forms.input type="email" name="email" label="Email"
                value="{{ old('email', app()->environment('local') ? env('DEMO_EMAIL') : '') }}" required="true"
                autocomplete="email" />
            <button type="submit">Forgot password</button>
        </form>
    @endif
</div>
<div>
    {{-- sign up --}}
    <a href="{{ route('auth.sign_up.index') }}">Sign Up</a>
    {{-- sign in --}}
    <a href="{{ route('auth.sign_in.index') }}">Sign In</a>
</div>
