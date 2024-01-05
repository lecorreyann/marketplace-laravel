<div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6">
  {{-- Add item --}}
  <x-button-link href="{{ route('items.create') }}" :with-icon="true">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    Add item
  </x-button-link>

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
