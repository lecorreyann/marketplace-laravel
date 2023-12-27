<!-- resources/views/components/layout.blade.php -->
<html>

<head>
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    {{-- menu top --}}
    <x-menus.top />

    {{-- auto --}}
    <div>{{ $slot }}</div>

    {{-- menu admin --}}
    @include('menu_admin')
</body>

</html>
