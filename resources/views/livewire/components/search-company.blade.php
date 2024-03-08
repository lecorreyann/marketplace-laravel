<div x-data="searchCompany({
    open: false,
    disabled: @entangle('disabled'),
    options: @entangle('options'),
    optionTextTopLeft: @entangle('optionTextTopLeft'),
    optionTextTopRight: @entangle('optionTextTopRight'),
    optionTextBottomLeft: @entangle('optionTextBottomLeft'),
    optionTextBottomRight: @entangle('optionTextBottomRight')
})">

    <div class="relative mt-2" @click.away="open = false">
        {{-- search --}}
        <div class="flex items-stretch">
            <div class="w-full">
                <x-input :label="$label" name="search-value" id="search-value" type="text" :placeholder="$placeholder"
                    wire:model.live.debounce.500ms='form.searchValue' autocomplete="off" @click="toggle"
                    data-form-type="other" x-ref="input" @keydown.arrow-down.prevent="handleArrowDown"
                    @keydown.arrow-up.prevent="handleArrowUp" @keydown.enter.stop.prevent="handleEnter" />
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



        {{-- options --}}
        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            x-ref="options"
            x-on:scroll="if($event.target.scrollHeight - $event.target.scrollTop === $event.target.clientHeight) { loadMoreResults() }"
            x-show="open && options.length > 0">
            <template x-for="(option, index) in options" :key="index">
                <li class="relative flex cursor-default select-none justify-between py-2 pl-3 pr-9 text-gray-900"
                    :class="{
                        'bg-indigo-600 text-white': focusedOption ===
                            index,
                        'font-semibold': selectedOption === index,
                        'opacity-50': (option['disabled'] && option['disabled'] === true)
                    }"
                    @mouseover="setFocusedOption(index)" @click="setSelectedOption(index)">
                    <div class="flex min-w-0 gap-x-4 pl-3">
                        <div class="min-w-0 flex-auto">
                            {{-- text top left --}}
                            <span x-show="Object.keys(option).includes(optionTextTopLeft)"
                                x-text="option[optionTextTopLeft]" class="text-sm font-semibold leading-6"></span>
                            {{-- text bottom left --}}
                            <span x-show="Object.keys(option).includes(optionTextBottomLeft)"
                                x-text="option[optionTextBottomLeft]" class="mt-1 flex text-xs leading-5"></span>
                        </div>
                    </div>

                    <div class="flex shrink-0 items-center gap-x-4">
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            {{-- text top right --}}
                            <span x-show="Object.keys(option).includes(optionTextTopRight)"
                                x-text="option[optionTextTopRight]" class="text-sm font-semibold leading-6"></span>
                            {{-- text bottom right --}}
                            <span x-show="Object.keys(option).includes(optionTextBottomRight)"
                                x-text="option[optionTextBottomRight]" class="mt-1 flex text-xs leading-5"></span>
                        </div>
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
        Alpine.data('searchCompany', (config) => {

            return {
                open: config.open,
                disabled: config.disabled,
                options: config.options,
                optionTextTopLeft: config.optionTextTopLeft,
                optionTextTopRight: config.optionTextTopRight,
                optionTextBottomLeft: config.optionTextBottomLeft,
                optionTextBottomRight: config.optionTextBottomRight,
                focusedOption: null,
                selectedOption: null,
                cleanup: null,
                differentSearch: true,
                // search: '',


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

                // handleKeyPress(event) {

                //     if (event.key && event.key === 'Enter') {
                //         return null;
                //     }


                //     // if key is a letter
                //     if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 8 || event.keyCode === 32) {
                //         const key = event.key.toLowerCase();
                //         if (!this.open && event.keyCode !== 8 || event.keyCode !== 32) this.open = true;

                //         if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 32)
                //             this.search += key;

                //         const matchOptionIndex = this.options.findIndex((option) => {
                //             return option[this.optionText].toLowerCase().startsWith(this.search);
                //         });


                //         if (Number.isInteger(matchOptionIndex)) {
                //             this.setFocusedOption(matchOptionIndex);

                //             // scroll to focused option
                //             const focusedOption = this.$refs.options.children[this.focusedOption]
                //             if (focusedOption) {
                //                 focusedOption.scrollIntoView({
                //                     block: 'center'
                //                 })
                //             }

                //         }
                //     } else {
                //         return null;
                //     }
                // },

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
                        $wire.dispatchSelf('updated-value', {
                            value: this.options[index]
                        });

                    }
                    // launch click on input to close options
                    this.$refs.input.click()
                },

                loadMoreResults() {
                    this.differentSearch = false;
                    $wire.dispatch('search');
                },

                // getFlag(option) {

                //     let countryCode = option['iso_3166-1_alpha-2'].toLowerCase();
                //     if (countryCode === 'ty') {
                //         countryCode = 'fr';
                //     } else if (countryCode === 'fx') {
                //         countryCode = 'fr';
                //     } else if (countryCode === 'tp') {
                //         countryCode = 'tl';
                //     }

                //     return `{{ Vite::asset('resources/img/flags/') }}${countryCode}.svg`;
                // },
                init() {

                    // this.$watch('search', ((newValue, oldValue) => {

                    //     // Clear the previous timeout if it exists
                    //     if (this.resetTimeout) {
                    //         clearTimeout(this.resetTimeout);
                    //     }

                    //     // Set a timeout to reset search after 500ms if it does not change
                    //     this.resetTimeout = setTimeout(() => {
                    //         if (this.search === newValue) {
                    //             this.search = '';
                    //         }
                    //     }, 500);
                    // }))

                    // listen to updated options
                    this.cleanup = Livewire.on('updated-options', ({
                        options
                    }) => {

                        // reset focused and selected option if search value is different
                        if (this.differentSearch === true) {
                            this.focusedOption = null;
                            this.selectedOption = null;
                        }

                        // this.focused = -1;
                        this.options = options;
                        // this.options = options;
                        this.differentSearch = true;

                        this.$nextTick(() => {
                            // open options if there are options
                            if (options.length > 0) {
                                this.open = true;
                            }
                        })

                    });
                },

                // destroy wire.on
                destroy() {
                    this.cleanup();
                }
            }
        })
    </script>
@endscript
