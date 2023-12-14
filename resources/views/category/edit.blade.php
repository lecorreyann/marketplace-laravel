<x-layout>
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @else
            <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                @csrf
                @method('PATCH')
                {{-- category.name --}}
                <x-forms.input type="text" name="name" label="Name" value="{{ old('name', $category->name) }}"
                    required="true" />
                {{-- category.slug --}}
                <x-forms.input type="text" name="slug" label="Slug" value="{{ old('slug', $category->slug) }}" />
                {{-- category.parent_id --}}
                <x-forms.select name="parent_id" label="Parent" :options="$categories" value="{{ $category->parent_id }}" />
                {{-- category.description --}}
                <button type="submit">Edit</button>
            </form>
        @endif
    </div>

    {{-- list --}}
    <a href="{{ route('admin.categories.index') }}">Categories</a>
</x-layout>
