<x-layouts.auth-layout>
    <div class="container mx-auto">
        <div>
            @if (session('success'))
                <div>
                    <x-alert type="success" :content="session('success')" />
                </div>
            @else
                @if (session('error'))
                    <x-alert alert-type="danger" :title="session('error')" />
                @endif
                <form action="{{ route('auth.forgot_password.store') }}" method="post">
                    @csrf
                    {{-- user.email --}}
                    <x-forms.input type="email" name="email" label="Email"
                        value="{{ old('email', app()->environment('local') ? env('DEMO_EMAIL') : '') }}" required="true"
                        autocomplete="email" />
                    <div class="mt-6 text-center"><x-buttons.submit text="Forgot Password" type="primary"
                            size="xl" /></div>
                </form>
            @endif
        </div>
    </div>
</x-layouts.auth-layout>
