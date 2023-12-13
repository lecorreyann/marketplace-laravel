{{-- if success --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{ dump(auth()->user()) }}
{{-- sign out --}}
@auth
    <form action="{{ route('auth.sign_out.delete') }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Sign Out</button>
    </form>
@endauth
