<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white shadow">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-5xl px-4">
        <div class="flex h-16 items-center justify-between">
            <div class="flex h-16">
                <!-- Logo -->
                <div class="flex flex-shrink-0 items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Vitrine') }}
                    </x-nav-link>
                    <x-nav-link :href="route('orders')" :active="request()->routeIs('orders')">
                        {{ __('Minhas compras') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden space-x-2 sm:ml-6 sm:flex sm:items-center">
                @auth
                    @can('create', \App\Models\Product::class)
                        <form action="{{ route('produto.create') }}" method="get">
                            <x-button class="mr-3" type="submit">{{ __('Vender produto') }}</x-button>
                        </form>
                    @else
                        <form action="{{ route('stripe.setup') }}" method="get">
                            <x-button class="mr-3" type="submit">{{ __('Quero vender') }}</x-button>
                        </form>
                    @endcan

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:border-gray-300 hover:text-gray-700 focus:border-gray-300 focus:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()?->name }}</div>

                                <div class="ml-1">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <form action="{{ route('login') }}" method="get">
                        <x-button type="submit">Entrar</x-button>
                    </form>
                    <form action="{{ route('register') }}" method="get">
                        <x-button type="submit">Criar conta</x-button>
                    </form>
                @endauth
            </div>

            <!-- Hamburger -->
            @auth
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @else
                <form action="{{ route('login') }}" class="sm:hidden">
                    <x-button type="submit">Entrar</x-button>
                </form>
            @endauth
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="space-y-1 pt-2 pb-3">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Vitrine') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pt-4 pb-1">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()?->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()?->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
