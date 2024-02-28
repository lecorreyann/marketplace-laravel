<x-admin-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.role.store') }}" method="post">
                @csrf
                {{-- role.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name') }}" required="true" />
                {{-- role.permissions --}}
                @foreach ($permissions as $permission)
                    <x-forms.checkbox name="permissions[]" id="{{ $permission->id }}" label="{{ $permission->name }}"
                        value="{{ $permission->id }}" checked="{{ false }}" />
                @endforeach
                <button type="submit">Create</button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.roles.index') }}">Roles</a>
</x-admin-layout>
