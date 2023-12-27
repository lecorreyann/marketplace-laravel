<header class="bg-white">
    <nav class="mx-auto flex max-w-7xl items-center justify-between gap-x-6 p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">Your Company</span>
                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt="">
            </a>
        </div>
        <div class="hidden lg:flex lg:gap-x-12 items-center">
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Cat 1</a>
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Cat 2</a>
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Cat 3</a>
            <x-buttons.link type="secondary" text="Sell" href="#"
                icon-start='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>'
                size="lg" type="primary" />
        </div>
        <div class="flex flex-1 items-center justify-end gap-x-6">
            @guest
                {{-- sign in --}}
                <x-buttons.link href="{{ route('auth.sign_in.index') }}" text="Sign In" size="lg" />
                {{-- sign up --}}
                <x-buttons.link href="{{ route('auth.sign_up.index') }}" text="Sign Up" type="primary" size="lg" />
            @endguest
            @auth
                {{-- Profile --}}
                <div class="flex">
                    <div class="relative">
                        <x-buttons.base
                            icon-start='<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>'
                            aria-expanded="false" />

                        <!--
                                                              'Profile' flyout menu, show/hide based on flyout menu state.

                                                              Entering: "transition ease-out duration-200"
                                                                From: "opacity-0 translate-y-1"
                                                                To: "opacity-100 translate-y-0"
                                                              Leaving: "transition ease-in duration-150"
                                                                From: "opacity-100 translate-y-0"
                                                                To: "opacity-0 translate-y-1"
                                                            -->
                        <div
                            class="absolute -left-8 top-full z-10 mt-3 w-96 rounded-3xl bg-white p-4 shadow-lg ring-1 ring-gray-900/5">
                            <div class="relative rounded-lg p-4 hover:bg-gray-50">
                                <a href="#" class="block text-sm font-semibold leading-6 text-gray-900">
                                    About us
                                    <span class="absolute inset-0"></span>
                                </a>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Learn more about our company values and
                                    mission
                                    to empower others</p>
                            </div>
                            <div class="relative rounded-lg p-4 hover:bg-gray-50">
                                <a href="#" class="block text-sm font-semibold leading-6 text-gray-900">
                                    Careers
                                    <span class="absolute inset-0"></span>
                                </a>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Looking for you next career opportunity?
                                    See
                                    all
                                    of our open positions</p>
                            </div>
                            <div class="relative rounded-lg p-4 hover:bg-gray-50">
                                <a href="#" class="block text-sm font-semibold leading-6 text-gray-900">
                                    Support
                                    <span class="absolute inset-0"></span>
                                </a>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Get in touch with our dedicated support
                                    team
                                    or
                                    reach out on our community forums</p>
                            </div>
                            <div class="relative rounded-lg p-4 hover:bg-gray-50">
                                <a href="#" class="block text-sm font-semibold leading-6 text-gray-900">
                                    Blog
                                    <span class="absolute inset-0"></span>
                                </a>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Read our latest announcements and get
                                    perspectives from our team</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- separator between profile and cart --}}
                <span class="mx-4 h-6 w-px bg-gray-200 lg:mx-6" aria-hidden="true"></span>

                {{-- Cart --}}
                <div class="flow-root">
                    <a href="#" class="group -m-2 flex items-center p-2">
                        <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">0</span>
                        <span class="sr-only">items in cart, view bag</span>
                    </a>
                </div>
                {{-- sign out --}}
                <form action="{{ route('auth.sign_out.delete') }}" method="post" class="m-0">
                    @csrf
                    @method('DELETE')
                    <x-buttons.submit text="Sign Out" />
                </form>
            @endauth
        </div>
        <div class="flex lg:hidden">
            <button type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div
            class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center gap-x-6">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                        alt="">
                </a>
                <a href="#"
                    class="ml-auto rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                    up</a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Product</a>
                        <a href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Features</a>
                        <a href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Marketplace</a>
                        <a href="#"
                            class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Company</a>
                    </div>
                    @guest
                        <div class="py-6">
                            <a href="#"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log
                                in</a>
                        </div>
                    @endguest
                    @auth
                        {{-- sign out --}}
                        <form action="{{ route('auth.sign_out.delete') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <x-buttons.submit text="Sign Out" />
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
