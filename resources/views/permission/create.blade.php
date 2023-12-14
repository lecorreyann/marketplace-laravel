<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.permission.store') }}" method="post">
                @csrf
                {{-- permission.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name') }}" required="true" />
                <button type="submit">Create</button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.permissions.index') }}">Permissions</a>
</x-layout>
