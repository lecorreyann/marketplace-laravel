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
            <form class="space-y-6" wire:submit='save'>



                {{-- company.country --}}
                <livewire:components.select id="country" name="country" label="Country" placeholder="Select a country"
                    :options="$countries" option-text="name" option-value="id" :type="App\Enums\SelectType::country" :disabled="false"
                    @updated-value="$dispatch('updated-country', {value: $event.detail.value})" :key="count($countries)" />

                @isset($form->country)
                    @switch($form->country['iso_3166-1_alpha-2'])
                        @case('FX')
                            <livewire:components.search-company label="Search company"
                                placeholder="Entreprise, N° SIREN, Dirigeant, Mot-clé..." id="company" option-value="id"
                                country="France" @updated-value="$dispatch('select-company', {value: $event.detail.value})" />
                        @break
                    @endswitch
                @endisset


                @isset($form->name)
                    <x-input id="name" name="name" type="text" label="Company name" placeholder="Company name"
                        wire:model='form.name' :readonly="true" />
                @endisset



                @if (isset($addresses) && count($addresses) > 0)
                    <livewire:components.select id="address" name="address" label="Select address"
                        placeholder="Select an address" :options="$addresses" option-text="address" option-value="id"
                        :type="App\Enums\SelectType::address" :disabled="false"
                        @updated-value="$dispatch('select-address', {value: $event.detail.value})" :otherOptionEnabled="true"
                        :key="substr(bin2hex(serialize($addresses[0])), -10)" />
                @endif

                @if ($customAddress)
                    <x-input id="address" name="address" type="text" label="Company address" placeholder="Address"
                        wire:model='form.address' autocomplete="street-address" />
                @endif

                @isset($form->identifier)
                    <x-input id="identifier" name="identifier" type="text"
                        label="{{ Str::ucfirst($form->identifierType->value) }}" placeholder="Identifier"
                        wire:model.blur='form.identifier' />
                @endisset

                <div>
                    <x-button type="submit" class="flex w-full justify-center leading-6">Register</x-button>
                </div>
            </form>
        </div>

    </div>

    @endif
</div>
