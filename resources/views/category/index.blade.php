<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- table --}}
        @if (count($categories))
            <table>
                <thead>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent_id }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', $category->id) }}">Edit</a>

                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        @endif
        {{-- create --}}
        <a href="{{ route('admin.category.create') }}">Create</a>
    </div>
</x-layout>
