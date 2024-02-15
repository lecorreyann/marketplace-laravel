<div x-data="select({
    open: false,
    selected: null,
    focused: null,
    search: '',
    options: {{ $options->toJSON() }},
    optionTextTopLeft: '{{ $optionTextTopLeft }}',
    optionTextTopRight: '{{ $optionTextTopRight }}',
    optionTextBottomLeft: '{{ $optionTextBottomLeft }}',
    optionTextBottomRight: '{{ $optionTextBottomRight }}',
    optionValue: '{{ $optionValue }}'
})" x-init="init()">

    <div class="relative mt-2" @keydown.escape="closeListOptions()" @click.away="closeListOptions()"
        @keydown.arrow-down.prevent="focusNextOption()" @keydown.arrow-up.prevent="focusPreviousOption()">


        {{-- SEARCH FIELD --}}
        <div class="flex items-stretch">
            <div class="w-full">
                <x-input label="Company" name="search-value" id="search-value" type="text" :placeholder="$placeholder"
                    wire:model.live.debounce.150ms='form.searchValue' autocomplete="disabled" @focus="openListOptions()"
                    @click="openListOptions()" @keydown.enter.stop.prevent="openListOptions()"
                    @keydown="handleKeyPress($event)" />
            </div>
            <div wire:loading.flex class="absolute bottom-[8px] right-0 flex self-end pr-4">
                <svg class="h-5 w-5 animate-spin text-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        </div>



        {{-- OPTIONS --}}
        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            tabindex="-1" role="listbox" aria-labelledby="{{ $id }}"
            :aria-activedescendant="'listbox-option-' + focused" x-ref="listbox"
            x-show="open == true && options.length > 0">


            @foreach ($options as $index => $option)
                <li @class([
                    'relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900 flex justify-between gap-x-6 py-5',
                    'opacity-50' => $disabledOptions->contains($option[$optionValue]),
                ])
                    :class="focused === {{ $index }} ? 'bg-indigo-600 text-white' : ''"
                    id="listbox-option-{{ $index }}" role="option"
                    @click="@if (!$disabledOptions->contains($option[$optionValue])) setSelectedOption({{ $option[$optionValue] }}) @endif"
                    @mouseover="setFocusedOption({{ $index }})" :key="{{ $option[$optionValue] }}">

                    <div class="flex min-w-0 gap-x-4 pl-3">
                        <div class="min-w-0 flex-auto">
                            {{-- Top Left Option Text --}}
                            <p class="text-sm font-semibold leading-6"
                                :class="focused === {{ $index }} ? 'text-white' : 'text-gray-900'">
                                <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                {{ Arr::get($option, $optionTextTopLeft, '') }}
                            </p>
                            {{-- Bottom Left Option Text --}}
                            <p class="mt-1 flex text-xs leading-5"
                                :class="focused === {{ $index }} ? 'text-white' : 'text-gray-500'">
                                {{ Arr::get($option, $optionTextBottomLeft, '') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-4">
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            {{-- Top Right Option Text --}}
                            <p class="text-sm leading-6"
                                :class="focused === {{ $index }} ? 'text-white' : 'text-gray-900'">
                                {{ Arr::get($option, $optionTextTopRight, '') }}
                            </p>
                            {{-- Bottom Right Option Text --}}
                            <p class="mt-1 text-xs leading-5"
                                :class="focused === {{ $index }} ? 'text-white' : 'text-gray-500'">
                                {{ Arr::get($option, $optionTextBottomRight, '') }}
                            </p>
                        </div>

                    </div>

                    {{-- SVG SELECT INDICATOR --}}
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4"
                        x-show="selected == {{ $option[$optionValue] }}"
                        :class="focused === {{ $index }} ? 'text-white' : 'text-indigo-600'"
                        id="listbox-option-0">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" :aria-hidden="selected === 1">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            @endforeach


        </ul>

    </div>






</div>

@script
    <script>
        Alpine.data('select', (config) => {
            return {
                selected: config.selected,
                focused: config.focused,
                search: '',
                options: config.options,
                open: config.open,
                optionTextTopLeft: config.optionTextTopLeft,
                optionTextTopRight: config.optionTextTopRight,
                optionTextBottomLeft: config.optionTextBottomLeft,
                optionTextBottomRight: config.optionTextBottomRight,
                optionValue: config.optionValue,


                focusNextOption() {

                    // open list options if not open
                    if (!this.open) this.openListOptions()

                    // handle focus
                    if (this.focused === null) {
                        this.focused = 0
                    } else {
                        if (this.focused === (this.options.length - 1)) {
                            this.focused = 0
                        } else {
                            this.focused++
                        }
                    }

                    this.$nextTick(() => {
                        const focusedElement = this.$refs.listbox.children[this.focused]
                        if (focusedElement) {
                            focusedElement.scrollIntoView({
                                block: 'nearest'
                            })
                        }
                    })

                },

                focusPreviousOption() {
                    // open list options if not open
                    if (!this.open) this.openListOptions()

                    // handle focus
                    if (this.focused === null) {
                        this.focused = this.options.length - 1
                    } else {
                        if (this.focused === 0) {
                            this.focused = this.options.length - 1
                        } else {
                            this.focused--
                        }
                    }

                    // scroll to focused option
                    this.$nextTick(() => {
                        const focusedElement = this.$refs.listbox.children[this.focused]
                        if (focusedElement) {
                            focusedElement.scrollIntoView({
                                block: 'nearest'
                            })
                        }
                    })
                },

                openListOptions() {
                    this.open = true
                },

                closeListOptions() {
                    this.open = false
                    console.log("ici")
                },

                toggleListOptions() {
                    if (!this.open) {
                        this.openListOptions()
                    } else {
                        this.closeListOptions()
                    }
                },

                setFocusedOption(index) {


                    this.focused = index
                },

                setSelectedOption(id) {
                    this.selected = id
                    this.closeListOptions()
                    $wire.dispatch('updated-value', {
                        value: this.selected
                    });
                    //this.getFlag()
                },

                handleKeydownEnter() {
                    if (!this.open) this.open = true
                    if (this.focused !== null && this.options[this.focused].activated !== 0) {
                        this.selected = this.options[this.focused][this.optionValue]
                        this.toggleListOptions()
                        $wire.dispatch('updated-value', {
                            value: this.selected
                        })
                    }
                },

                handleKeyPress(event) {

                    console.log(1)
                    // if key is a letter
                    if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 8 || event.keyCode === 32) {

                        console.log(2)

                        const key = event.key.toLowerCase();
                        console.log(3)
                        if (!this.open && event.keyCode !== 8 || event.keyCode !== 32) this.open = true;
                        console.log(4)

                        if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 32) this.search += key;
                        console.log(5)

                        const matchOptionIndex = this.options.findIndex((option) => {


                            return option[this.optionTextTopLeft].toLowerCase().startsWith(this
                                    .search) ||
                                option[
                                    this.optionTextBottomLeft].toLowerCase().startsWith(this
                                    .search) ||
                                option[
                                    this.optionTextTopRight].toLowerCase().startsWith(this
                                    .search) ||
                                option[
                                    this.optionTextBottomRight].toLowerCase().startsWith(this
                                    .search);
                        });


                        if (Number.isInteger(matchOptionIndex)) {
                            this.focused = matchOptionIndex;

                            // scroll to focused option
                            this.$nextTick(() => {
                                const focusedElement = this.$refs.listbox.children[this.focused]
                                if (focusedElement) {
                                    focusedElement.scrollIntoView({
                                        block: 'nearest'
                                    })
                                }
                            })
                        }



                    } else {
                        return null;
                    }
                },

                getFlag() {
                    if (this.selected === null) return null;
                    const selectedOption = Object.values(this.options).find(item => item[this
                            .optionValue] === this
                        .selected);
                    let countryCode = selectedOption['iso_3166-1_alpha-2'].toLowerCase();
                    if (countryCode === 'ty') {
                        countryCode = 'fr';
                    } else if (countryCode === 'fx') {
                        countryCode = 'fr';
                    } else if (countryCode === 'tp') {
                        countryCode = 'tl';
                    }

                    return `{{ Vite::asset('resources/img/flags/') }}${countryCode}.svg`;
                },


                // watch this.search for changes
                init() {



                    this.$watch('search', ((newValue, oldValue) => {

                        // Clear the previous timeout if it exists
                        if (this.resetTimeout) {
                            clearTimeout(this.resetTimeout);
                        }

                        // Set a timeout to reset search after 500ms if it does not change
                        this.resetTimeout = setTimeout(() => {
                            if (this.search === newValue) {
                                this.search = '';
                            }
                        }, 500);
                    }))


                    $wire.on('updated-options', ({
                        options
                    }) => {
                        this.options = options
                        // this.options = options;
                        if (this.options.length > 0) this.open = true;
                    });
                },

            }
        })
    </script>
@endscript
