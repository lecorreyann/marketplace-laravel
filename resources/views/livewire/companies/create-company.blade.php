<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">


    <div class="sm:mx-auto sm:w-full sm:max-w-md">

        @if (session()->has('success') || session()->has('success.title') || session()->has('success.message'))
            <x-session />
        @else
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register your company
                to start selling your products</h2>

            @if (session()->has('error') || session()->has('error.title') || session()->has('error.message'))
                <x-alert alert-type="danger" title="{{ session()->has('error.title') ? session('error.title') : null }}"
                    class="mt-2">
                    {{ session()->has('error.message') ? session('error.message') : session('error') }}
                </x-alert>
            @endif

    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[720px]">
        <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
            <form class="space-y-6">

                {{-- company.country --}}
                <livewire:components.select id="country" name="country" label="Country" placeholder="Select a country"
                    :options="$countries" option-text="name" option-value="id" :type="App\Enums\SelectType::country" :disabled="false"
                    :disabledOptions="$countries->where('activated', false)->pluck('id')" @updated-value="$dispatch('updated-country', {value: $event.detail.value})" />

                {{-- display country --}}

                @isset($form->country)
                    @switch(App\Models\Country::find($form->country)->name)
                        @case('France')
                            <livewire:components.search-company label="Company"
                                placeholder="Entreprise, N° SIREN, Dirigeant, Mot-clé..." id="company" option-value="id"
                                country="France" />
                        @break

                        @default
                        @break
                    @endswitch
                @endisset




                {{-- company.email --}}

                <div>
                    <x-button type="submit" class="flex w-full justify-center leading-6">Register</x-button>
                </div>
            </form>
        </div>

    </div>

    @endif
</div>
