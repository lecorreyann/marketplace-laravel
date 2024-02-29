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

                {{-- display company search --}}

                @if (!$form->name)
                    @isset($form->country)
                        @switch(App\Models\Country::find($form->country)['iso_3166-1_alpha-2'])
                            @case('FX')
                                <livewire:components.search-company label="Company"
                                    placeholder="Entreprise, N° SIREN, Dirigeant, Mot-clé..." id="company" option-value="id"
                                    country="France" @updated-value="$dispatch('updated-company', {value: $event.detail.value})" />
                            @break

                            @default
                            @break
                        @endswitch
                    @endisset

                    {{-- display company details --}}
                @else
                    <x-input id="name" name="name" label="Company name" type="text"
                        placeholder="Company name" wire:model="form.name" :disabled="true" />

                    <x-input id="identifier" name="identifier" label="Company {{ $form->identifierType }}"
                        type="text" placeholder="identifier" wire:model="form.identifier" :disabled="true" />

                    <x-input id="address" name="address" label="Address" type="text" placeholder="Address"
                        wire:model="form.address" :disabled="true" />

                    <x-input id="postalCode" name="postalCode" label="Postal code" type="text"
                        placeholder="Postal code" wire:model.blur="form.postalCode" :disabled="true" />

                    <x-input id="city" name="city" label="City" type="text" placeholder="City"
                        wire:model="form.city" :disabled="true" />
                @endif



                {{-- company.email --}}
                <div>
                    <x-button type="submit" class="flex w-full justify-center leading-6">Register</x-button>
                </div>
            </form>
        </div>

    </div>

    @endif
</div>
