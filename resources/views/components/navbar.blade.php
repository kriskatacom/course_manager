<header class="bg-white shadow sticky top-0 z-50" x-data="{ mobileMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Лого -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold">
                    Learnova
                </a>
            </div>

            <!-- Главна навигация (desktop) -->
            <nav class="hidden md:flex space-x-6 items-center">

                <a href="#" class="text-gray-700 hover:text-primary font-medium">{{ __("messages.home") }}</a>
                <a href="#" class="text-gray-700 hover:text-primary font-medium">{{ __("messages.about_us") }}</a>

                <!-- Courses dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @mouseenter="open = true" @mouseleave="open = false" class="text-gray-700 hover:text-primary font-medium flex items-center space-x-1" x-transition>
                        <span>{{ __("messages.courses") }}</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>

                    <div x-show="open" @mouseenter="open = true" @mouseleave="open = false" class="absolute pt-2 min-w-[300px] bg-white shadow-lg rounded-md py-1 z-50" x-cloak>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Програмиране</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Дизайн</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Маркетинг</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Бизнес и предприемачество</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Езици</a>
                    </div>
                </div>

                <a href="#" class="text-gray-700 hover:text-primary font-medium">{{ __("messages.blog") }}</a>
                <a href="#" class="text-gray-700 hover:text-primary font-medium">{{ __("messages.contacts") }}</a>
            </nav>

            <!-- User actions (desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <a href="{{ route("users.login") }}" class="navbar-link">{{ __("messages.login") }}</a>
                    <a href="{{ route("users.register") }}" class="navbar-bg-link">{{ __("messages.register") }}</a>
                @else
                    <div x-data="{ open: false }" class="relative" x-cloak>
                        <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
                            {{ Auth::user()->name }}
                            <i class="fa-solid fa-chevron-down ml-1"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-1 z-50">
                            @if(auth()->check() && auth()->user()->hasPermission('access-admin'))
                                <a href="{{ route("admin.dashboard") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __("messages.administration") }}</a>
                            @endif

                            <a href="{{ route("users.profile.show") }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ __("messages.profile") }}</a>
                            
                            <form method="POST" action="{{ route("users.logout") }}">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-100 text-left w-full">{{ __("messages.logout") }}</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenu = !mobileMenu" class="page-icon-button">
                    <i x-show="!mobileMenu" class="fa-solid fa-bars text-2xl"></i>
                    <i x-show="mobileMenu" class="fa-solid fa-times text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenu" @click.away="mobileMenu = false" class="md:hidden bg-white shadow-lg" x-cloak>
        <nav class="px-2 pt-2 pb-3 space-y-1">
            <a href="#" class="navbar-link">{{ __("messages.home") }}</a>
            <a href="#" class="navbar-link">{{ __("messages.about_us") }}</a>

            <!-- Dropdown за курсове (мобилно меню – показва се при клик на „Курсове“) -->
            <div x-data="{ open: false }" class="block">
                <button @click="open = !open" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary flex justify-between items-center">
                    {{ __("messages.courses") }}
                    <i class="fa-solid fa-chevron-down text-sm"></i>
                </button>

                <div x-show="open" @click.away="open = false" class="mt-1 pl-4 space-y-1" x-cloak>
                    <a href="#" class="navbar-link">Програмиране</a>
                    <a href="#" class="navbar-link">Дизайн</a>
                    <a href="#" class="navbar-link">Маркетинг</a>
                    <a href="#" class="navbar-link">Бизнес и предприемачество</a>
                    <a href="#" class="navbar-link">Езици</a>
                </div>
            </div>

            <a href="#" class="navbar-link">{{ __("messages.blog") }}</a>
            <a href="#" class="navbar-link">{{ __("messages.contacts") }}</a>

            @guest
                <a href="{{ route("users.login") }}" class="navbar-link">{{ __("messages.login") }}</a>
                <a href="{{ route("users.register") }}" class="btn-primary button-primary">{{ __("messages.register") }}</a>
            @else
            <a href="{{ route("users.profile.show") }}" class="navbar-link">{{ Auth::user()->name }}</a>
            
                @if(auth()->check() && auth()->user()->hasPermission('access-admin'))
                    <a href="{{ route("admin.dashboard") }}" class="navbar-link">{{ __("messages.administration") }}</a>
                @endif

                <form method="POST" action="{{ route("users.logout") }}">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn-primary btn-danger">{{ __("messages.logout") }}</button>
                </form>
            @endguest
        </nav>
    </div>
</header>
