<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        <form action="{{ route('auth.sign_up.store') }}" method="post">
            @csrf
            {{-- user.first_name --}}
            <x-forms.input type="text" name="first_name" label="First name" value="{{ old('first_name', 'Yann') }}"
                required="true" />
            {{-- user.last_name --}}
            <x-forms.input type="text" name="last_name" label="Last name" value="{{ old('last_name', 'Le Corre') }}"
                required="true" />
            {{-- user.email --}}
            <x-forms.input type="email" name="email" label="Email"
                value="{{ old('email', app()->environment('local') ? 'yannlc@posteo.net' : '') }}" required="true" />
            {{-- user.password --}}
            <x-forms.input type="password" name="password" label="Password" required="true" value="12345678" />
            {{-- user.password confirmed --}}
            <x-forms.input type="password" name="password_confirmation" label="Password confirmation" required="true"
                value="12345678" />

            <button type="submit">Sign Up</button>
        </form>
    @endif
</div>
<div>
    {{-- sign in --}}
    <a href="{{ route('auth.sign_in.index') }}">Sign In</a>
</div>
