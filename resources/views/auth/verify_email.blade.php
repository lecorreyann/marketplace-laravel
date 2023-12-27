<x-layouts.auth-layout>
    <div class="container mx-auto">
        @if (session('success'))
            <div>
                <x-alert type="success" :content="session('success')" />
            </div>
        @else
            {{-- invite user to resend validation link if expired --}}
            @if (session('error') == 'Token expired.')
                <x-alert alert-type="danger" :title="session('error')" />
                <form action="{{ route('auth.verify_email.store') }}" method="post">
                    @csrf
                    <x-forms.input type="email" name="email" label="Email"
                        value="{{ old('email', app()->environment('local') ? env('DEMO_EMAIL') : '') }}" required="true"
                        autocomplete="email" />
                    <div class="mt-6 text-center"><x-buttons.submit text="Resend verification link" type="primary"
                            size="xl" /></div>

                </form>
            @endif
        @endif
    </div>
    </div>
</x-layouts.auth-layout>
