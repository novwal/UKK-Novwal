<nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Main Navigation -->
            <div class="flex items-center space-x-6">
                <!-- Brand Name as Text Only -->
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors duration-200">
                    When<span class="font-extrabold">Yah</span>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center space-x-1 ml-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Home') }}
                    </x-nav-link>
                    
                    @if(auth()->check() && auth()->user()->role === 'USER')
                    <x-nav-link :href="route('user.reports')" :active="request()->routeIs('user-reports')" class="px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Reports') }}
                    </x-nav-link>
                    @endif
                    
                    @if(auth()->check() && (auth()->user()->role === 'STAFF' || auth()->user()->role === 'HEAD_STAFF'))
                    <x-nav-link :href="route('report.index')" :active="request()->routeIs('report')" class="px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Reports') }}
                    </x-nav-link>
                    @endif
                    
                    @if(auth()->check() && auth()->user()->role === 'HEAD_STAFF')
                    <x-nav-link :href="route('staff-management.index')" :active="request()->routeIs('staff-management.*')" class="px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        {{ __('User Management') }}
                    </x-nav-link>
                    <x-nav-link :href="route('head-staff.dashboard')" :active="request()->routeIs('head-staff.*')" class="px-3 py-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Analytics') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- User Actions -->
            <div class="flex items-center space-x-4">
                @if (!Auth::user())
                <div class="flex space-x-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors duration-200">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-sm">
                        Get Started
                    </a>
                </div>
                @else
                <!-- User Dropdown -->
                <div class="hidden md:block relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-full p-1">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2 text-gray-700 hover:bg-gray-50 px-4 py-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </x-dropdown-link>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center space-x-2 text-gray-700 hover:bg-gray-50 px-4 py-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                {{ __('Home') }}
            </x-responsive-nav-link>

            @if(auth()->check() && auth()->user()->role === 'USER')
            <x-responsive-nav-link :href="route('user.reports')" :active="request()->routeIs('user-reports')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                {{ __('Reports') }}
            </x-responsive-nav-link>
            @endif
            
            @if(auth()->check() && (auth()->user()->role === 'STAFF' || auth()->user()->role === 'HEAD_STAFF'))
            <x-responsive-nav-link :href="route('report.index')" :active="request()->routeIs('report')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                {{ __('Reports') }}
            </x-responsive-nav-link>
            @endif
            
            @if(auth()->check() && auth()->user()->role === 'HEAD_STAFF')
            <x-responsive-nav-link :href="route('staff-management.index')" :active="request()->routeIs('staff-management.*')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                {{ __('User Management') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('head-staff.dashboard')" :active="request()->routeIs('head-staff.*')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                {{ __('Analytics') }}
            </x-responsive-nav-link>
            @endif
        </div>

        @if (Auth::user())
        <div class="pt-4 pb-3 border-t border-gray-200 px-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-medium">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
            
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endif
    </div>
</nav>