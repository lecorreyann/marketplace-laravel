<x-layouts.layout>


    {{-- if success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


</x-layouts.layout>
