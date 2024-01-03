<x-marketplace-layout>

    {{-- if error --}}


    {{-- if success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


</x-marketplace-layout>
