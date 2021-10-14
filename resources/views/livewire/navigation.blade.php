<header class="bg-white text-black shadow-lg sticky top-0" style="z-index: 900" x-data="dropdown()">
    <div class="container flex items-center h-16 justify-between md:justify-start">
        <a 
            :class="{'bg-opacity-100 text-white bg-blue-400' : open}"
            x-on:click="show()"
            class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-gray-800 bg-opacity-25 text-gray-800 font-bold h-full">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path  class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="font-bold text-sm hidden md:block">
                Categorías
            </span>
        </a>
        <a href="/" class="mx-6">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>

        <div class="flex-1 hidden md:block">
            @livewire('search')
        </div>

        <!-- IR a config, jetstream y descomentar la linea Features::profilePhotos(),, para mistrar foro de perfil -->
        <!-- Settings Dropdown -->
        <div class="mx-6 relative hidden md:block">
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                    {{--  Muestra la foto de perfil o el nombre --}}
                    {{--  @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()) --}}
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                    {{--  @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        @endif --}}
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            Mis ordenes
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('admin.index') }}">
                            Admin
                        </x-jet-dropdown-link>

                        {{-- @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                        @endif --}}

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @else
                
                <x-jet-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Login') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('Register') }}
                        </x-jet-dropdown-link>
                    </x-slot>

                </x-jet-dropdown>
                
            @endauth
        </div>

        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>
        

    </div>

    <nav id="nav-menu"
        :class="{'block': open, 'hidden': !open}"
        class="bg-greenLime-100 bg-opacity-25  w-full absolute hidden">

        {{-- menu desktop --}}
        <div class="container h-full hidden md:block">
            <div 
                x-on:click.away="close()"
                class="grid grid-cols-4 h-full relative">
                <ul class="bg-white">
                    @foreach ($categories as $category)

                        <li class="nav-link text-gray-500 font-bold hover:bg-blue-400  hover:text-white">
                            <a href="{{ route('categories.show', $category) }}" class="py-2 px-4 text-sm flex items-center">
                                <span class="flex justify-center w-9">
                                    {!!$category->icon!!}
                                </span>
                                {{$category->name}}
                            </a>

                            <div class="nav-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                <x-nav-subcategories :category="$category" />
                            </div>
                        </li>
                    
                    @endforeach
                </ul>
                <div class="col-span-3 bg-gray-100">
                    <!-- 
                        si lleva 2 puntos :variable, se le puede pasar un objeto array,json
                        si no lo lleva, solo acepta enteros y cedenas
                    -->
                    <x-nav-subcategories :category="$categories->first()" />
                </div>
            </div>
        </div>

        {{-- Menu mobile --}}
        <div class="bg-white h-full overflow-auto">

            <div class="container bg-gray-200 py-4 mb-2">
                @livewire('search')
            </div>
            <ul>
                @foreach ($categories as $category)
                    <li class="text-gray-500 font-bold hover:bg-blue-400  hover:text-white">
                        <a href="{{ route('categories.show', $category) }}" class="py-2 px-4 text-sm flex items-center">
                            <span class="flex justify-center w-9">
                                {!!$category->icon!!}
                            </span>
                            {{$category->name}}
                        </a>
                    </li>
                @endforeach
            </ul>

            <p class="text-trueGray-500 px-6 my-2">
                USUARIOS
            </p>

            @livewire('cart-mobil');

            @auth
                <a href="{{ route('profile.show') }}" class="py-2 px-4 text-sm flex items-center text-gray-500 font-bold hover:bg-blue-400  hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fas fa-address-card"></i>
                    </span>
                    Perfil
                </a>
                <a  href=""
                    onclick="event.preventDefault() 
                    document.getElementById('logout-form').submit()"       
                    class="py-2 px-4 text-sm flex items-center text-gray-500 font-bold hover:bg-blue-400  hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf

                </form>
            
                @else

                <a href="{{ route('login') }}" class="py-2 px-4 text-sm flex items-center text-gray-500 font-bold hover:bg-blue-400  hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fas fa-user-circle"></i>
                    </span>
                    Iniciar Sesión
                </a>
                <a  href="{{ route('register') }}"     
                    class="py-2 px-4 text-sm flex items-center text-gray-500 font-bold hover:bg-blue-400  hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="fas fa-fingerprint"></i>
                    </span>
                    Registrarse
                </a>

            @endauth
        </div>
    </nav>
</header>


