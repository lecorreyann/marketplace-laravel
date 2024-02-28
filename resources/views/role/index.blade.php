<x-admin-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        {{-- table --}}
        @if (count($roles))
            <table>
                <thead>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <span>{{ $permission->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ !$role->locked ? route('admin.role.edit', $role->id) : '' }}"
                                    @if ($role->locked) aria-disabled="true" @endif>Edit</a>

                                <form action="{{ route('admin.role.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        @if ($role->locked) disabled @endif>Delete</button>
                                </form>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        @endif
        {{-- create --}}
        <a href="{{ route('admin.role.create') }}">Create</a>
    </div>
</x-admin-layout>
