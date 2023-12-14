<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.permission.update', $permission->id) }}" method="post">
                @csrf
                @method('PATCH')
                {{-- permission.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name', $permission->name) }}"
                    required="true" />
                <button type="submit">Edit</button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.permissions.index') }}">Permissions</a>
</x-layout>
