<div x-data="select({ open: false, selected: null, focused: null, search: '', options: {{ $options->toJSON() }}, optionText: '{{ $optionText }}', optionValue: '{{ $optionValue }}' })" x-init="init()">

    <label id="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <div class="relative mt-2" @keydown.escape="closeListOptions()" @click.away="closeListOptions()">
        <button type="button" @click="@if (!$disabled) toggleListOptions() @endif"
            @class([
                'relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6',
                'cursor-not-allowed bg-gray-50 text-gray-500 ring-gray-200' => $disabled,
            ]) aria-haspopup="listbox" :aria-expanded="open"
            aria-labelledby="{{ $id }}"
            @keydown.enter.stop.prevent="@if (!$disabled) handleKeydownEnter() @endif"
            @keydown.arrow-down.prevent="focusNextOption()" @keydown.arrow-up.prevent="focusPreviousOption()"
            @keydown="handleKeyPress($event)">
            <template x-if="selected===null">
                <span class="flex items-center">
                    <span class="block truncate text-gray-500">
                        {{ $placeholder }}
                    </span>
                </span>
            </template>
            <template x-if="selected!=null">
                <span class="flex items-center">
                    {{-- Country flags --}}
                    @if ($type === \App\Enums\SelectType::country)
                        <img :src="getFlag()" alt="flag" class="h-5 w-5 rounded-full">
                    @endif
                    <span class="ml-3 block truncate"
                        x-text="selected ? Object.values(options).find(item => item[optionValue] === selected)[optionText] : 'No option selected'">
                    </span>
                </span>
            </template>
            <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <template x-if="open">
            <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                tabindex="-1" role="listbox" aria-labelledby="{{ $id }}"
                :aria-activedescendant="'listbox-option-' + focused" x-ref="listbox">

                @foreach ($options as $index => $option)
                    <li @class([
                        'relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900',
                        'opacity-50' => $disabledOptions->contains($option->id),
                    ])
                        :class="focused === {{ $index }} ? 'bg-indigo-600 text-white' : ''"
                        id="listbox-option-{{ $index }}" role="option"
                        @click="@if (!$disabledOptions->contains($option->id)) setSelectedOption({{ $option->id }}) @endif"
                        @mouseover="setFocusedOption({{ $index }})" :key="{{ $option->id }}">

                        <div class="flex items-center">
                            {{-- Country flags --}}
                            @if ($type === \App\Enums\SelectType::country)
                                @php
                                    $countryCode = Str::lower($option['iso_3166-1_alpha-2']);
                                    if ($countryCode === 'ty') {
                                        $countryCode = 'fr';
                                    } elseif ($countryCode === 'fx') {
                                        $countryCode = 'fr';
                                    } elseif ($countryCode === 'tp') {
                                        $countryCode = 'tl';
                                    }
                                @endphp
                                <img src="{{ Vite::asset('resources/img/flags/' . $countryCode . '.svg') }}"
                                    alt="flag" class="h-5 w-5 rounded-full">
                            @endif
                            <!-- Selected: "font-semibold", Not Selected: "font-normal" -->

                            <span class='ml-3 block truncate'
                                :class="selected === {{ $option[$optionValue] }} ? 'font-semibold' : 'font-normal'">{{ $option[$optionText] }}</span>
                        </div>


                        <span class="absolute inset-y-0 right-0 flex items-center pr-4"
                            x-show="selected == {{ $option->id }}"
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
        </template>


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
                optionText: config.optionText,
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
                    // if key is a letter
                    if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 8 || event.keyCode === 32) {
                        const key = event.key.toLowerCase();
                        if (!this.open && event.keyCode !== 8 || event.keyCode !== 32) this.open = true;

                        if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 32)
                            this.search += key;

                        const matchOptionIndex = this.options.findIndex((option) => {
                            return option[this.optionText].toLowerCase().startsWith(this.search);
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
                    const selectedOption = Object.values(this.options).find(item => item[this.optionValue] === this
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
                },

            }
        })
    </script>
@endscript
