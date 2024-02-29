<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
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
                <x-input type="text" name="name" id="name" label="Name" wire:model="name" :required="true"
                    :readonly="true" id="name" />
                <x-button type="submit">Edit</x-button>
                {{-- country.activated --}}
                <x-forms.checkbox name="activated" label="activated" :value="true" :checked="(bool) $country->activated === true ? true : false"
                    id="activated" />
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.countries.index') }}">Countries</a>
</div>
