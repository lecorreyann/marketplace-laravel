{{-- Meta --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- Title --}}
<title>{{ $title ?? config('app.name', 'Marketplace') }}</title>

{{-- Vite --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
