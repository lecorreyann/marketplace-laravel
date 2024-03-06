<div>
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
                    <th>Create company (select country)</th>
                    <th>Create company (input phone)</th>
                    <th>Actions</th>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->create_company_select_country_enable }}</td>
                            <td>{{ $country->create_company_input_phone_enable }}</td>
                            <td>
                                <a href="{{ route('admin.country.edit', $country->id) }}">Edit</a>
                        </tr>
                    @endforeach
                </tbody>
                </thead>
            </table>
        @endif
    </div>
</div>
