<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form wire:submit='update'>
            @csrf
            @method('PATCH')

            {{-- get id from route --}}
            {{-- {{ dump(App\Models\Country::find(request()->route('id'))) }} --}}



            {{-- country.name --}}
            <x-input type="text" name="name" id="name" label="Name" wire:model="form.name" :required="true"
                :readonly="true" id="name" />
            <x-button type="submit">Edit</x-button>


            {{-- country.create_company_select_country_enable --}}
            <x-checkbox name="create_company_select_country_enable" label="Create company (select country)"
                wire:model="form.create_company_select_country_enable" id="create_company_select_country_enable" />
            {{-- country.create_company_input_phone_enable --}}
            <x-checkbox name="create_company_input_phone_enable" label="Create company (input phone)"
                wire:model='form.create_company_input_phone_enable' id="create_company_input_phone_enable" />
        </form>
    </div>

    {{-- list --}}
    <a href="{{ route('admin.countries.index') }}">Countries</a>
</div>
