<header class="relative bg-white">
  {{-- Top announcement --}}
  {{-- @include('components.menus.top-nav.desktop._top-announcement') --}}

  {{-- Menu desktop --}}
  <nav aria-label="Top" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="border-b border-gray-200">
      <div class="flex h-16 items-center">
        {{-- Mobile menu toggle, controls the 'mobileMenuOpen' state. --}}
        <button type="button" class="relative rounded-md bg-white p-2 text-gray-400 lg:hidden">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>

        {{-- Logo --}}
        <div class="ml-4 flex lg:ml-0">
          <a href="#">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
          </a>
        </div>

        {{-- Flyouts --}}
        {{-- @include('components.menus.top-nav.desktop._links') --}}


        <div class="ml-auto flex items-center">

          {{-- Auth --}}
          @include('components.menus.top-nav.desktop._auth')

          {{-- Currency selector --}}
          {{-- @include('components.menus.top-nav.desktop._currency-selector') --}}

          {{-- Search --}}
          {{-- @include('components.menus.top-nav.desktop._search') --}}

          {{-- Cart --}}
          {{-- @include('components.menus.top-nav.desktop._cart') --}}

        </div>
      </div>
    </div>
  </nav>
</header>
