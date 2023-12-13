<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        <form action="{{ route('auth.sign_in.store') }}" method="post">
            @csrf
            {{-- user.email --}}
            <x-forms.input type="email" name="email" label="Email"
                value="{{ old('email', app()->environment('local') ? 'yannlc@posteo.net' : '') }}" required="true"
                autocomplete="email" />
            {{-- user.password --}}
            <x-forms.input type="password" name="password" label="Password" required="true"
                @env('local') value="12345678" @endenv />
            {{-- forgot password --}}
            <a href="{{ route('auth.forgot_password.index') }}">Forgot password?</a>
            {{-- remember me --}}
            <button type="submit">Sign In</button>
        </form>

        @if ($errors->first('email') === 'The email address is not verified.')
            <form action="{{ route('auth.verify_email.store') }}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ old('email') }}">
                If you did not receive the email, please check your spam folder or <button type="submit">click here
                    to resend</button>.
            </form>
        @endif
    @endif
</div>
<div>
    {{-- sign up --}}
    <a href="{{ route('auth.sign_up.index') }}">Sign Up</a>
</div>
