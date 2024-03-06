<div>
    {{-- select country --}}
    <livewire:components.select :id="$selectId" :name="$selectName" placeholder="Select a country" :options="$countries"
        option-text="name" option-value="id" :type="App\Enums\SelectType::country_flag" :disabled="false" :disabledOptions="$countries->where('create_company_input_phone_enable', false)->pluck('id')"
        @updated-value="$dispatch('updated-country', {value: $event.detail.value})" label={{ $label }} />
</div>
