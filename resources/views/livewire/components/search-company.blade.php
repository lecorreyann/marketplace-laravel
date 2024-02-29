<div x-data="select({
    open: false,
    selected: null,
    focused: null,
    search: '',
    options: @entangle('options'),
    optionTextTopLeft: '{{ $optionTextTopLeft }}',
    optionTextTopRight: '{{ $optionTextTopRight }}',
    optionTextBottomLeft: '{{ $optionTextBottomLeft }}',
    optionTextBottomRight: '{{ $optionTextBottomRight }}',
    optionValue: '{{ $optionValue }}',
    listboxId: '{{ 'listbox-' . $id }}'
})">

    <div class="relative mt-2" @keydown.escape="closeListOptions()" @keydown.arrow-down.prevent="focusNextOption()"
        @keydown.arrow-up.prevent="focusPreviousOption()">




        {{-- SEARCH FIELD --}}
        <div class="flex items-stretch">
            <div class="w-full">
                <x-input label="Company" name="search-value" id="search-value" type="text" :placeholder="$placeholder"
                    wire:model.live.debounce.500ms='form.searchValue' autocomplete="off"
                    @click="if(options.length > 0){ openListOptions() }" @keydown="handleKeyPress($event)"
                    data-form-type="other" @click.away="closeListOptions()" />
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
            tabindex="1" role="listbox" aria-labelledby="{{ $id }}" id="{{ 'listbox-' . $id }}"
            :aria-activedescendant="'listbox-option-' + focused" x-show="open"
            x-on:scroll="if($event.target.scrollHeight - $event.target.scrollTop === $event.target.clientHeight) { loadMoreResults() }">

            @foreach ($options as $index => $option)
                <li @class([
                    'relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900 flex justify-between gap-x-6 py-5 focus:outline-none focus:bg-indigo-600 focus:text-white group',
                    'opacity-50' => $disabledOptions->contains($option[$optionValue]),
                ]) id="listbox-option-{{ $index }}" role="option"
                    @click="@if (!$disabledOptions->contains($option[$optionValue])) setSelectedOption({{ $option[$optionValue] }}) @endif"
                    @keydown.enter.stop.prevent="@if (!$disabled && !$disabledOptions->contains($option[$optionValue])) setSelectedOption({{ $option[$optionValue] }}) @endif"
                    @mouseover="setFocusedOption({{ $index }})" :key="{{ $option[$optionValue] }}"
                    tabindex="1">

                    <div class="flex min-w-0 gap-x-4 pl-3">
                        <div class="min-w-0 flex-auto">
                            {{-- Top Left Option Text --}}
                            <p class="text-sm font-semibold leading-6">
                                <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                {{ Arr::get($option, $optionTextTopLeft, '') }}
                            </p>
                            {{-- Bottom Left Option Text --}}
                            <p class="mt-1 flex text-xs leading-5">
                                {{ Arr::get($option, $optionTextBottomLeft, '') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-4">
                        <div class="hidden sm:flex sm:flex-col sm:items-end">
                            {{-- Top Right Option Text --}}
                            <p class="text-sm leading-6">
                                {{ Arr::get($option, $optionTextTopRight, '') }}
                            </p>
                            {{-- Bottom Right Option Text --}}
                            <p class="mt-1 text-xs leading-5">
                                {{ Arr::get($option, $optionTextBottomRight, '') }}
                            </p>
                        </div>

                    </div>

                    {{-- SVG SELECT INDICATOR --}}
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4"
                        :class="{
                            'text-indigo-600': selected == {{ $option[$optionValue] }} && focused !=
                                {{ $index }},
                            'group-focus:text-white': selected == {{ $option[$optionValue] }}
                        }"
                        x-show="selected == {{ $option[$optionValue] }}" id="listbox-option-{{ $index }}">
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
                listboxId: config.listboxId,
                cleanup: null,



                focusNextOption() {


                    // open list options if not open
                    if (!this.open && this.options.length > 0) this.openListOptions()


                    this.$nextTick(() => {
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


                        if (document.getElementById(this.listboxId)) {


                            const focusedElement = document.getElementById(this.listboxId).children[this
                                .focused]

                            if (focusedElement) {
                                focusedElement.focus()
                                focusedElement.scrollIntoView({
                                    block: 'nearest'
                                })
                            }
                        }

                    })



                },

                focusPreviousOption() {
                    // open list options if not open
                    if (!this.open && this.options.length > 0) this.openListOptions()


                    // scroll to focused option
                    this.$nextTick(() => {

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

                        if (document.getElementById(this.listboxId)) {

                            const focusedElement = document.getElementById(this.listboxId).children[this
                                .focused]

                            if (focusedElement) {

                                focusedElement.focus()
                                focusedElement.scrollIntoView({
                                    block: 'nearest'
                                })
                            }
                        }

                    })
                },

                openListOptions() {
                    if (this.options.length > 0) this.open = true

                },

                closeListOptions() {
                    this.open = false
                },

                setFocusedOption(index) {

                    this.focused = index
                    // change tabindex to focused option
                    if (document.getElementById(this.listboxId) && document.getElementById(this.listboxId).children[
                            index]) {
                        document.getElementById(this.listboxId).children[index].focus()
                    }
                },

                setSelectedOption(id) {
                    this.selected = id
                    this.closeListOptions()
                    $wire.dispatch('updated-value', {
                        value: this.options[this.options.findIndex(option => option[this.optionValue] ==
                            id)]
                    });
                },

                handleKeyPress(event) {

                    // if key is a letter
                    if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 8 || event.keyCode === 32) {

                        const key = event.key.toLowerCase();


                        // if (!this.open && event.keyCode !== 8 || event.keyCode !== 32) this.open = true;


                        if (event.keyCode >= 65 && event.keyCode <= 90 || event.keyCode === 32) this.search += key;

                        if (this.options.length) {
                            const matchOptionIndex = this.options.findIndex((option) => {

                                if (option[this.optionTextTopLeft])
                                    return option[this.optionTextTopLeft].toLowerCase().startsWith(this
                                        .search)
                                else if (option[this.optionTextBottomLeft])
                                    return option[
                                        this.optionTextBottomLeft].toLowerCase().startsWith(this
                                        .search)
                                else if (option[this.optionTextTopRight])
                                    return option[
                                        this.optionTextTopRight].toLowerCase().startsWith(this
                                        .search)
                                else if (option[this.optionTextBottomRight])
                                    return option[
                                        this.optionTextBottomRight].toLowerCase().startsWith(this
                                        .search);
                            });


                            if (Number.isInteger(matchOptionIndex)) {
                                this.focused = matchOptionIndex;


                                // scroll to focused option
                                this.$nextTick(() => {
                                    if (document.getElementById(this.listboxId)) {

                                        const focusedElement = document.getElementById(this.listboxId)
                                            .children[this
                                                .focused]
                                        if (focusedElement) {
                                            focusedElement.scrollIntoView({
                                                block: 'nearest'
                                            })
                                        }
                                    }
                                })
                            }
                        }



                    } else {
                        return null;
                    }
                },

                loadMoreResults() {
                    $wire.dispatch('search');
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


                    this.cleanup = Livewire.on('updated-options', ({
                        options
                    }) => {

                        this.open = false
                        // this.focused = -1;
                        this.options = options;
                        // this.options = options;
                        if (this.options.length > 0) this.open = true;

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
