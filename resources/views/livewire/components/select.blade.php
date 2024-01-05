<div @class([
  $class ??  null => $class,
])
    x-data="select({ data: {{ $options->toJSON() }}, emptyOptionsMessage: 'No countries match your search.', name: 'country', placeholder: '{{ $placeholder }}' })"
    x-init="init()"
>

  {{-- label --}}
  @if(!!$label)
    <label class="block text-sm font-medium leading-6 text-gray-900" id="{{ $id }}-listbox-label" x-on:click="focusButton()">{{ $label }}</label>
  @endif
  <div

    @click.outside="closeListbox()"
    @keydown.escape="closeListbox()"
    class="relative"
  >
    <button
      x-ref="button"
      @click.prevent="toggleListboxVisibility()"
      :aria-expanded="open"
      aria-haspopup="listbox"
      class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
      @keydown.enter.stop.prevent="selectOption()"
      @keydown.arrow-up.prevent="focusPreviousOption()"
      @keydown.arrow-down.prevent="focusNextOption()"
      aria-labelledby="{{ $id }}-listbox-label"
    >

      {{-- selected option --}}
      <span
        {{-- x-show="! open" --}}
        x-text="value in options.map((item) => item.{!! $optionValue !!}) ? options.find(item => item.{!! $optionValue !!} === value).{{$optionText}} : placeholder"
        :class="{ 'text-gray-500': ! (value in options.map((item) => item.{!! $optionValue !!})) }"
        class="block truncate"
      ></span>

      {{-- search --}}
      {{-- <input
              x-ref="search"
              x-show="open"
              x-model="search"
              @keydown.enter.stop.prevent="selectOption()"
              @keydown.arrow-up.prevent="focusPreviousOption()"
              @keydown.arrow-down.prevent="focusNextOption()"
              type="search"
              class="w-full h-full form-control focus:outline-none"
      /> --}}
      <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
          </svg>
      </span>
    </button>


    <div
        x-show="open"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-cloak
        class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
    >

      <ul
        x-ref="listbox"
        @keydown.enter.stop.prevent="selectOption()"
        @keydown.arrow-up.prevent="focusPreviousOption()"
        @keydown.arrow-down.prevent="focusNextOption()"
        role="listbox"
        :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
        tabindex="-1"
        class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
        aria-labelledby="{{ $id }}-listbox-label"
      >

        <template x-for="(key, index) in Object.keys(options)" :key="index">
          <li
            :id="name + 'Option' + focusedOptionIndex"
            @click="selectOption()"
            @mouseenter="focusedOptionIndex = index"
            @mouseleave="focusedOptionIndex = null"
            role="option"
            :aria-selected="focusedOptionIndex === index"
            :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
            class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900"
          >
            {{-- selected option text value --}}
            <span x-text="Object.values(options)[index].{{$optionText}}"
                  :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                  class="block font-normal truncate"
            ></span>

            {{-- selected option checkmark --}}
            <span
              x-show="Object.values(options)[index].{{$optionValue}} === value"
              :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
              class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
            >
              <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"/>
              </svg>
            </span>
          </li>
        </template>

        {{-- empy search message --}}
        {{-- <div
          x-show="!Object.keys(options).length"
          x-text="emptyOptionsMessage"
          class="px-3 py-2 text-gray-900 cursor-default select-none"></div> --}}
      </ul>
    </div>

  </div>

  {{-- hidden input --}}
  <input
      x-ref="input"
      type="hidden"
      name="{{ $name }}"
      :value="value"
  />

  <script>
      function select(config) {
          return {
              data: config.data,

              emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',

              focusedOptionIndex: null,

              name: config.name,

              open: false,

              options: {},

              placeholder: config.placeholder ?? 'Select an option',

              search: '',

              value: config.value,

              closeListbox: function () {
                  this.open = false

                  this.focusedOptionIndex = null

                  this.search = ''
              },

              focusNextOption: function () {
                  if (!this.open) return this.toggleListboxVisibility()

                  if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1

                  if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) this.focusedOptionIndex = 0

                  else this.focusedOptionIndex++

                  // if focused option is 0 scroll top of listbox into view
                  if (this.focusedOptionIndex === 0) return this.$refs.listbox.scrollTop = 0


                  return this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                  })

              },

              focusPreviousOption: function () {
                  if (!this.open) return this.toggleListboxVisibility()

                  if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

                  if (this.focusedOptionIndex <= 0) this.focusedOptionIndex = Object.keys(this.options).length - 1

                  else this.focusedOptionIndex--

                  this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                      block: "center",
                  })
              },

              focusButton: function () {
                  this.$refs.button.focus()
              },

              init: function () {
                  this.options = this.data

                  if (!(this.value in this.options)) this.value = null

                  this.$watch('search', ((value) => {
                      if (!this.open || !value) return this.options = this.data

                      this.options = Object.keys(this.data)
                          .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
                          .reduce((options, key) => {
                              options[key] = this.data[key]
                              return options
                          }, {})
                  }))
              },

              selectOption: function () {
                  if (!this.open) return this.toggleListboxVisibility()
                  let optionValue = @json($optionValue);
                  this.value = Object.values(this.options)[this.focusedOptionIndex][optionValue]
                  this.closeListbox()
              },

              toggleListboxVisibility: function () {
                  if (this.open) return this.closeListbox()

                  this.focusedOptionIndex = this.options.findIndex((item) => item.{!! $optionValue !!} === this.value)

                  if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                  this.open = true

                  this.$nextTick(() => {
                    if(this.$refs.search) this.$refs.search.focus()

                      this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                          block: "nearest"
                      })
                  })
              },
          }
      }
  </script>
</div>
