<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @else
        {{-- invite user to resend validation link if expired --}}
        @if (session('error') == 'Token expired.')
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
            <form action="{{ route('auth.verify_email.store') }}" method="post">
                @csrf
                <x-forms.input type="email" name="email" label="Email"
                    value="{{ old('email', app()->environment('local') ? 'yannlc@posteo.net' : '') }}" required="true"
                    autocomplete="email" />
                <button type="submit">Resend verification link</button>
            </form>
        @endif
    @endif
</div>
