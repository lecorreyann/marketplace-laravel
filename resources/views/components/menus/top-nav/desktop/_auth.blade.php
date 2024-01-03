<div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
  @guest
    {{-- Sign in --}}
    <a href="{{ route('auth.sign_in.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</a>
    <span class="h-6 w-px bg-gray-200" aria-hidden="true"></span>
    {{-- Create account --}}
    <a href="{{ route('auth.sign_up.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</a>
  @endguest
  @auth
    {{-- Logout --}}
    <form method="POST" action="{{ route('auth.sign_out.delete') }}">
      @csrf
      @method('DELETE')
      <button href="{{ route('auth.sign_out.delete') }}" class="text-sm font-medium text-gray-700 hover:text-gray-800">Logout</button>
    </form>
  @endauth
</div>
