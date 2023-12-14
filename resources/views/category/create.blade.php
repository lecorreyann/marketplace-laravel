<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.category.store') }}" method="post">
                @csrf
                {{-- category.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name') }}" required="true" />
                {{-- category.slug --}}
                <x-forms.input type="text" name="slug" label="Slug"
                    value="{{ (old('slug') ? old('slug') : old('name')) ? Str::slug(old('name')) : '' }}" />
                {{-- category.parent_id --}}
                <x-forms.select name="parent_id" label="Parent" :options="$categories" />
                {{-- category.description --}}
                <button type="submit">Create</button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.categories.index') }}">Categories</a>
</x-layout>
