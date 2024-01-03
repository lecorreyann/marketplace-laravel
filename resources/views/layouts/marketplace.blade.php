<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts._head')
    </head>
    <body>
      <div>
        {{-- Top Nav --}}
        <x-menus.top-nav.base />

        <main>
            {{ $slot }}
        </main>
      </div>
    </body>
</html>
