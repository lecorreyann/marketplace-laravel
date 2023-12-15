<x-layout>
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
        @if (count($countries))
            <table>
                <thead>
                    <th>Name</th>
                    <th>Activated</th>
                    <th>Actions</th>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->activated }}</td>
                            <td>
                                <a href="{{ route('admin.country.edit', $country->id) }}">Edit</a>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        @endif
    </div>
</x-layout>
