<!-- resources/views/components/layout.blade.php -->
<html>

<head>
    <title>{{ $title ?? 'Todo Manager' }}</title>
</head>

<body>
    {{ $slot }}

    {{-- menu admin --}}
    @include('menu_admin')
</body>

</html>
