<x-admin-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.permission.store') }}" method="post">
                @csrf
                {{-- permission.name --}}
                <x-input type="text" name="name" id="name" label="Name" value="{{ old('name') }}"
                    required="true" />
                <x-button type="submit">Create</x-button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.permissions.index') }}">Permissions</a>
</x-admin-layout>
