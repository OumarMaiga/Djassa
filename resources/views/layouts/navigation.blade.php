<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 w-full" style="z-index:35; position:fixed; top:0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-4">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <span class="sm:hidden pt-1 mr-2" id="sidebar-toggle">
                        <ion-icon name="grid-outline" style="font-size:1.5em; color:#1A1A1A"></ion-icon>
                    </span>
                    <a href="{{ route('welcome') }}">
                        <h1 class="inline-flex items-center" style="font-size:24px; font-weight:800; color:#ec8333">DJASSA</h1>
                    </a>
                </div>

                <!-- Search -->
                <form class="hidden sm:flex flex-col" action="{{route('search')}}" id="search-form" method="GET">
                    <input style="height:3rem; width:14rem; background:#F6F6F6; padding-left:1rem; border-radius:6px; margin-left:1rem; margin-top:1rem" name="query" placeholder="Rechercher un produit"/>
                </form>
                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-6 sm:flex">
                    @if(Auth::check() && (Auth::user()->type === "super-admin" || Auth::user()->type === "admin"))
                        <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                    <!-- @if($cartCount ?? '' )
                        <span style="margin-top:1.5rem" class="position-relative">
                            <a href="{{ route('panier.index') }}">
                                <ion-icon name="cart-outline" style="font-size:2em; color:#1A1A1A"></ion-icon>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color:#ec6333">{{ $cartCount }}</span>
                            </a>
                        </span>
                    @endif -->
                    @if (Auth::check())
                        @if(Auth::user()->type === "super-admin" || Auth::user()->type === "admin")
                        <x-nav-link :href="route('dashboard.commande.index')">
                            Commandes
                        </x-nav-link> 
                        <x-nav-link :href="route('dashboard.service.index')">
                            Services
                        </x-nav-link>
                        @endif
                        
                        @if(Auth::user()->type === "user")
                            <x-nav-link :href="route('my_commande', Auth::user()->id)">
                                Commandes
                            </x-nav-link> 
                            <x-nav-link :href="route('service.index', Auth::user()->id)">
                                Services
                            </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-3">
                @if($cartCount ?? '' )
                    <span style="margin-top:0.6rem; margin-right:2rem" class="position-relative">
                        <a href="{{ route('panier.index') }}">
                            <ion-icon name="cart-outline" style="font-size:2em; color:#1A1A1A"></ion-icon>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color:#ec6333">{{ $cartCount }}</span>
                        </a>
                    </span>
                @endif
                @if (Auth::check())
                <x-dropdown align="right" width="48">

                    <x-slot name="content">
                        @if (Auth::check())
                            @if(Auth::user()->type === "super-admin" || Auth::user()->type === "admin")
                                <x-dropdown-link :href="route('dashboard.index')">
                                    Dashboard
                                </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('user.show', Auth::user()->id)">
                                Profil
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endif
                    </x-slot>
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div style="font-size:16px; color:#1A1A1A; margin-right:-0.2rem" class="text-base">{{ Auth::check() ? Auth::user()->name : "" }} <span style="position: absolute; margin-top:0.2rem; margin-left:0.1rem;"><ion-icon name="chevron-down-outline"></ion-icon></span></div>
                        </button>
                    </x-slot>
                </x-dropdown>
                @else
                <x-nav-link :href="route('login')">
                    Login
                </x-nav-link>
                <x-nav-link :href="route('register')">
                    register
                </x-nav-link>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Search -->
        <form action="{{route('search')}}" id="search-form" method="GET">
            <input style="height:2rem; width:21rem; background:#F6F6F6; padding-left:1rem; border-radius:5px; margin-left:1.5rem; margin-top:0.75rem" name="query" placeholder="Rechercher un produit"/>
        </form>

        <!-- Navigation Links -->
        <div class="ml-5 mt-2">
            @if(Auth::check() && (Auth::user()->type === "super-admin" || Auth::user()->type === "admin"))
                <div>
                    <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard')">
                        <span class="text-base">{{ __('Dashboard') }}</span>     
                    </x-nav-link>
                </div>
            @endif
            <!-- @if($cartCount ?? '' )
                <span style="margin-top:1.5rem" class="position-relative">
                    <a href="{{ route('panier.index') }}">
                        <ion-icon name="cart-outline" style="font-size:2em; color:#1A1A1A"></ion-icon>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color:#ec6333">{{ $cartCount }}</span>
                    </a>
                </span>
            @endif -->
            @if (Auth::check())
                @if(Auth::user()->type === "super-admin" || Auth::user()->type === "admin")
                <div>
                    <x-nav-link :href="route('dashboard.commande.index')">
                        <span class="text-base">Commandes</span> 
                    </x-nav-link> 
                </div>
                <div>
                    <x-nav-link :href="route('dashboard.service.index')">
                        <span class="text-base">Services</span> 
                    </x-nav-link>
                </div>
                @endif
                
                @if(Auth::user()->type === "user")
                    <div>
                        <x-nav-link :href="route('my_commande', Auth::user()->id)">
                            <span class="text-base">Commandes</span> 
                        </x-nav-link> 
                    </div>
                    <div>
                        <x-nav-link :href="route('service.index', Auth::user()->id)">
                            <span class="text-base">Services</span> 
                        </x-nav-link>
                    </div>
                @endif
            @endif
        </div>

        <!-- Settings Dropdown -->
        <div class="ml-5 mt-2">
            @if($cartCount ?? '' )
                <span style="margin-top:0.6rem; margin-right:2rem" class="position-relative">
                    <a href="{{ route('panier.index') }}">
                        <ion-icon name="cart-outline" style="font-size:2em; color:#1A1A1A"></ion-icon>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background-color:#ec6333">{{ $cartCount }}</span>
                    </a>
                </span>
            @endif
            @if (Auth::check())
            <x-dropdown align="left" width="48">

                <x-slot name="content">
                    @if (Auth::check())
                        @if(Auth::user()->type === "super-admin" || Auth::user()->type === "admin")
                            <x-dropdown-link :href="route('dashboard.index')">
                                Dashboard
                            </x-dropdown-link>
                        @endif
                        <x-dropdown-link :href="route('user.show', Auth::user()->id)">
                            Profil
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    @endif
                </x-slot>
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div style="font-size:16px; color:#1A1A1A; margin-right:-5rem" class="text-base">{{ Auth::check() ? Auth::user()->name : "" }} <span style="position: absolute; margin-top:0.2rem; margin-left:0.1rem;"><ion-icon name="chevron-down-outline"></ion-icon></span></div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>
            </x-dropdown>
            @else
            <div>
                <x-nav-link :href="route('login')">
                   <span class="text-base">Connexion</span> 
                </x-nav-link>
            </div>
            <div>
                <x-nav-link :href="route('register')">
                <span class="text-base">Inscription</span> 
                </x-nav-link>
            </div>
            @endif
        </div>

        <!-- <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                <p class="pl-3">{{ __('Dashboard') }}</p>
            </x-responsive-nav-link>
        </div> -->

    </div>
</nav>
