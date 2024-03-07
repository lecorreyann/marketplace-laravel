<div x-data="select({
    open: false,
    disabled: @entangle('disabled'),
    options: {{ $options }},
    optionText: @entangle('optionText'),
    placeholder: @entangle('placeholder'),
    type: @entangle('type')
})">
    {{-- label --}}
    <x-label :for="$id" :label="$label" />

    <div class="relative mt-2" @click.away="open = false">
        {{-- select --}}
        <button type="button"
            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
            :class="disabled ? 'cursor-not-allowed bg-gray-50 text-gray-500 ring-gray-200' : ''" @click="toggle"
            id="{{ $id }}" @keydown.arrow-down.prevent="handleArrowDown"
            @keydown.arrow-up.prevent="handleArrowUp" @keydown="handleKeyPress($event)"
            @keydown.enter.stop.prevent="handleEnter" x-ref="button">
            <span class="flex items-center gap-3">
                {{-- selectedOption === null --}}
                <template x-if="selectedOption === null">
                    <span class="block truncate text-gray-500" x-text="placeholder"></span>
                </template>

                {{-- selectedOption !== null --}}
                <template x-if="selectedOption!=null">
                    <span class="flex items-center gap-3">
                        <template x-if="type === 'country'">
                            <img :src="getFlag(options[selectedOption])" alt="flag" class="h-5 w-5 rounded-full">
                        </template>
                        <span class="block truncate" x-text="options[selectedOption][optionText]">
                        </span>
                    </span>
                </template>
            </span>
        </button>


        {{-- options --}}
        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            x-ref="options" x-show="open">
            <template x-for="(option, index) in options" :key="index">
                <li class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900"
                    :class="{
                        'bg-indigo-600 text-white': focusedOption ===
                            index,
                        'font-semibold': selectedOption === index,
                        'opacity-50': (option['disabled'] && option['disabled'] === true)
                    }"
                    @mouseover="setFocusedOption(index)" @click="setSelectedOption(index)">
                    <div class="flex items-center gap-3">
                        <template x-if="type === 'country'">
                            <img :src="getFlag(option)" alt="flag" class="h-5 w-5 rounded-full">
                        </template>
                        <span x-text="option[optionText]"></span>
                    </div>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4" x-show="selectedOption === index"
                        :class="focusedOption ===
                            index ? 'text-white' : 'text-indigo-600'"
                        :id="'listbox-option-' + index">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                            :aria-hidden="selectedOption === 1">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>
        </ul>

    </div>
</div>

@script
    <script>
        Alpine.data('select', (config) => {

            return {
                open: config.open,
                disabled: config.disabled,
                options: config.options,
                optionText: config.optionText,
                focusedOption: null,
                selectedOption: null,
                search: '',
                placeholder: config.placeholder,
                type: config.type,

                handleArrowDown() {
                    // set focused option
                    if (this.focusedOption === null || this.focusedOption === (this.options.length - 1)) {
                        this.setFocusedOption(0)
                        this.$nextTick(() => {
                            const focusedOption = this.$refs.options.children[this.focusedOption]
                            if (focusedOption) {
                                focusedOption.scrollIntoView({
                                    block: 'center'
                                })
                            }
                        })
                    } else if (this.focusedOption < (this.options.length - 1)) {
                        this.setFocusedOption(this.focusedOption + 1)
                    }
                    // scroll into list options
                    const focusedOption = this.$refs.options.children[this.focusedOption]
                    // if focused option is 0 scroll top
                    if (focusedOption) {
                        if (this.focusedOption === 0) {
                            this.$refs.options.scrollTop = 0
                        }
                        focusedOption.scrollIntoView({
                            block: 'center'
                        })
                    }

                },

                handleArrowUp() {
                    // set focused option
                    if (this.focusedOption === null || this.focusedOption === 0) {
                        this.setFocusedOption(this.options.length - 1)
                    } else if (this.focusedOption > 0) {
                        this.setFocusedOption(this.focusedOption - 1)
                    }
                    // scroll into list options
                    const focusedOption = this.$refs.options.children[this.focusedOption]
                    if (focusedOption) {
                        focusedOption.scrollIntoView({
                            block: 'center'
                        })
                    }

                },

                handleEnter() {
                    if (this.focusedOption !== null) {
                        this.setSelectedOption(this.focusedOption)
                    }
                },

                handleKeyPress(event) {

                    if (event.key && event.key === 'Enter') {
                        return null;
                    }


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
                            this.setFocusedOption(matchOptionIndex);

                            // scroll to focused option
                            const focusedOption = this.$refs.options.children[this.focusedOption]
                            if (focusedOption) {
                                focusedOption.scrollIntoView({
                                    block: 'center'
                                })
                            }

                        }
                    } else {
                        return null;
                    }
                },

                toggle() {
                    // toggle open
                    this.open = !this.open

                    // scroll to focused option
                    if (this.open === true && this.focusedOption !== null) {
                        this.$nextTick(() => {
                            this.$refs.options.children[this.focusedOption].scrollIntoView({
                                block: 'center'
                            })
                        })
                    }
                },

                setFocusedOption(index) {
                    this.focusedOption = index
                },

                setSelectedOption(index) {

                    // if option is disabled
                    if (this.options[index]['disabled'] && this.options[index]['disabled'] === true) return null;

                    // if selected option is different
                    if (this.selectedOption !== index) {
                        this.selectedOption = index
                        // wire
                        $wire.dispatch('updated-value', {
                            value: this.options[index]
                        });


                    }
                    // launch click on focus button to close the options
                    this.$refs.button.click()
                },

                getFlag(option) {

                    let countryCode = option['iso_3166-1_alpha-2'].toLowerCase();
                    if (countryCode === 'ty') {
                        countryCode = 'fr';
                    } else if (countryCode === 'fx') {
                        countryCode = 'fr';
                    } else if (countryCode === 'tp') {
                        countryCode = 'tl';
                    }

                    return `{{ Vite::asset('resources/img/flags/') }}${countryCode}.svg`;
                },


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
                }
            }
        })
    </script>
@endscript
