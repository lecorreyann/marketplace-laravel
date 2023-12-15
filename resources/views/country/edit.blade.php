<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.country.update', $country->id) }}" method="post">
                @csrf
                @method('PATCH')
                {{-- country.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name', $country->name) }}"
                    :required="true" :readonly="true" />
                <button type="submit">Edit</button>
                {{-- country.activated --}}
                <x-forms.checkbox name="activated" label="activated" :value="true" :checked="(bool) $country->activated === true ? true : false" id="activated" />
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.countries.index') }}">Countries</a>
</x-layout>
