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
        @if (count($permissions))
            <table>
                <thead>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->created_at }}</td>
                            <td>{{ $permission->updated_at }}</td>
                            <td>
                                <a href="{{ !$permission->locked ? route('admin.permission.edit', $permission->id) : '' }}"
                                    @if ($permission->locked) aria-disabled="true" @endif>Edit</a>

                                <form action="{{ route('admin.permission.destroy', $permission->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        @if ($permission->locked) disabled @endif>Delete</button>
                                </form>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        @endif
        {{-- create --}}
        <a href="{{ route('admin.permission.create') }}">Create</a>
    </div>
</x-admin-layout>
