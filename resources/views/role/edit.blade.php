<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                @csrf
                @method('PATCH')
                {{-- role.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name', $role->name) }}"
                    required="true" />
                {{-- role.permissions --}}
                @foreach ($permissions as $permission)
                    <x-forms.checkbox name="permissions[]" id="{{ $permission->id }}" label="{{ $permission->name }}"
                        value="{{ $permission->id }}"
                        checked="{{ $role->hasPermission($permission->name) ? true : false }}" />
                @endforeach
                <button type="submit">Edit</button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.roles.index') }}">Roles</a>
</x-layout>
