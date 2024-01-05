<x-marketplace-layout>
  <div class="container mx-auto">
    <div>
    {{-- if error --}}
    {{-- if success --}}
    @if (session('success'))
    <div>
        <x-alert alert-type="success">
          {{ session('success') }}
        </x-alert>
    </div>
    @endif

    </div>
  </div>
</x-marketplace-layout>
