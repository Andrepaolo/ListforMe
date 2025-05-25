<nav x-data="{ open: false }" class="bg-white border-b border-[#e2dfd3] shadow-sm"> {{-- Colores tierra --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        {{-- Ícone do Carrinho como logo da aplicação --}}
                        <svg class="w-8 h-8 text-[#556b2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-2xl font-extrabold text-[#556b2f]">List for Me</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('stores') }}" :active="request()->routeIs('stores')" class="text-[#556b2f] hover:text-[#8f9779]">
                        {{ __('LOJAS AFILIADAS') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('product') }}" :active="request()->routeIs('product')" class="text-[#556b2f] hover:text-[#8f9779]">
                        {{ __('Produtos') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('cart') }}" :active="request()->routeIs('cart')" class="text-[#556b2f] hover:text-[#8f9779]">
                        {{ __('Carrinho') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('recipes') }}" :active="request()->routeIs('recipes')" class="text-[#556b2f] hover:text-[#8f9779]">
                        {{ __('Receitas') }}
                    </x-nav-link>
                    
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#556b2f] bg-white hover:text-[#8f9779] focus:outline-none focus:bg-[#e2dfd3] active:bg-[#e2dfd3] transition ease-in-out duration-150"> {{-- Colores para botón de equipo --}}
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-[#7a7a58]"> {{-- Color de texto --}}
                                        {{ __('Manage Team') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" class="text-[#556b2f] hover:bg-[#f5f0e6]"> {{-- Colores de links en dropdown --}}
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-[#e2dfd3]"></div> {{-- Color del borde --}}

                                        <div class="block px-4 py-2 text-xs text-[#7a7a58]">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" class="text-[#556b2f] hover:bg-[#f5f0e6]" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-[#8f9779] transition"> {{-- Color del borde del avatar --}}
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#556b2f] bg-white hover:text-[#8f9779] focus:outline-none focus:bg-[#e2dfd3] active:bg-[#e2dfd3] transition ease-in-out duration-150"> {{-- Colores para botón de usuario --}}
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-[#7a7a58]"> {{-- Color de texto --}}
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}" class="text-[#556b2f] hover:bg-[#f5f0e6]"> {{-- Colores de links en dropdown --}}
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-[#e2dfd3]"></div> {{-- Color del borde --}}

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                                 @click.prevent="$root.submit();"
                                                 class="text-[#556b2f] hover:bg-[#f5f0e6]">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#7a7a58] hover:text-[#556b2f] hover:bg-[#e2dfd3] focus:outline-none focus:bg-[#e2dfd3] focus:text-[#556b2f] transition duration-150 ease-in-out"> {{-- Colores para botón hamburguesa --}}
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-[#556b2f] hover:bg-[#f5f0e6]"> {{-- Colores para responsive links --}}
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('product') }}" :active="request()->routeIs('product')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                {{ __('Produtos') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('cart') }}" :active="request()->routeIs('cart')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                {{ __('Carrinho') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('recipes') }}" :active="request()->routeIs('recipes')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                {{ __('Receitas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('stores') }}" :active="request()->routeIs('stores')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                {{ __('LOJAS AFILIADAS') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-[#e2dfd3]"> {{-- Color del borde --}}
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-[#556b2f]">{{ Auth::user()->name }}</div> {{-- Color de texto --}}
                    <div class="font-medium text-sm text-[#7a7a58]">{{ Auth::user()->email }}</div> {{-- Color de texto --}}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <div class="border-t border-[#e2dfd3]"></div> {{-- Color del borde --}}

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                           @click.prevent="$root.submit();"
                                           class="text-[#556b2f] hover:bg-[#f5f0e6]">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-[#e2dfd3]"></div> {{-- Color del borde --}}

                    <div class="block px-4 py-2 text-xs text-[#7a7a58]">
                        {{ __('Manage Team') }}
                    </div>

                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')" class="text-[#556b2f] hover:bg-[#f5f0e6]">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-[#e2dfd3]"></div> {{-- Color del borde --}}

                        <div class="block px-4 py-2 text-xs text-[#7a7a58]">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" class="text-[#556b2f] hover:bg-[#f5f0e6]" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>