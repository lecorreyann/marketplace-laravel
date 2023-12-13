<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
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
            <x-forms.input type="password" name="password_confirmation" label="Password confirmation" required="true"
                value="{{ app()->environment('local') ? env('DEMO_PASSWORD') : '' }}" />

            <button type="submit">Reset password</button>
        </form>
    @endif
</div>
<div>
    {{-- sign up --}}
    <a href="{{ route('auth.sign_up.index') }}">Sign Up</a>
    {{-- sign in --}}
    <a href="{{ route('auth.sign_in.index') }}">Sign In</a>
</div>
