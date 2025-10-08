<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Redesign</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-inter { font-family: 'Inter', sans-serif; }

        .nav-link-hover {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link-hover:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #ec4899;
            transition: width 0.3s ease;
        }

        .nav-link-hover:hover:after {
            width: 100%;
        }

        .active-nav-link {
            position: relative;
            color: #ec4899;
        }

        .active-nav-link:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #ec4899;
        }

        .dropdown-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .logo-glow {
            filter: drop-shadow(0 0 8px rgba(236, 72, 153, 0.4));
        }

        .mobile-menu-bg {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .badge-glow {
            box-shadow: 0 0 5px rgba(236, 72, 153, 0.3);
        }

        .user-avatar {
            background: linear-gradient(135deg, #ec4899, #8b5cf6);
        }
    </style>
</head>
<body class="font-inter bg-gradient-to-br from-pink-50 to-white">
    <!-- Navigation Bar -->
    <nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-pink-100 sticky top-0 z-50 shadow-sm">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ Auth::user() && Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center">
                            <div class="logo-glow">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">R</span>
                                </div>
                            </div>
                            <span class="ml-2 font-playfair text-xl font-bold text-gray-800">RJ VISUAL STORIES</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex items-center">
                        <!-- Untuk user biasa -->
                        @auth
                            @if(!Auth::user()->isAdmin())
                                <a href="{{ route('dashboard') }}"
                                   class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('dashboard') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                                    {{ __('Dashboard') }}
                                </a>
                            @endif
                        @endauth

                        <a href="{{ route('packages.index') }}"
                           class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('packages.*') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                            {{ __('Paket') }}
                        </a>

                        @auth
                            <!-- Untuk user biasa -->
                            @if(!Auth::user()->isAdmin())
                                <a href="{{ route('orders.index') }}"
                                   class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('orders.*') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                                    {{ __('Pesanan Saya') }}
                                </a>
                            @endif

                            <!-- Untuk admin -->
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                   class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                                    {{ __('Admin Dashboard') }}
                                </a>
                                <a href="{{ route('admin.users.index') }}"
                                   class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.users.*') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                                    {{ __('Kelola User') }}
                                </a>
                                <a href="{{ route('admin.statistics') }}"
                                   class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.statistics') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                                    {{ __('Statistik') }}
                                </a>
                                <a href="{{ route('admin.packages.index') }}"
                                   class="nav-link-hover text-gray-600 font-medium py-2 px-3 rounded-lg transition-all duration-300 {{ request()->routeIs('admin.packages.*') ? 'active-nav-link text-pink-600' : 'hover:text-pink-600' }}">
                                    {{ __('Kelola Paket') }}
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-pink-50 focus:outline-none transition ease-in-out duration-300 shadow-sm border-pink-100">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full user-avatar flex items-center justify-center mr-2">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        </div>
                                        <div>{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="ml-2 text-xs px-2 py-1 rounded-full badge-glow {{ Auth::user()->getRoleBadgeColor() }}">
                                        {{ Auth::user()->getRoleDisplayName() }}
                                    </div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-3 text-sm text-gray-600 border-b bg-gray-50">
                                    <div class="font-medium">Logged in as:</div>
                                    <div class="flex items-center mt-1">
                                        <div class="w-6 h-6 rounded-full user-avatar flex items-center justify-center mr-2">
                                            <span class="text-white font-bold text-xs">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <div>{{ Auth::user()->name }}</div>
                                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <span class="{{ Auth::user()->getRoleBadgeColor() }} px-2 py-1 rounded-full text-xs">{{ Auth::user()->getRoleDisplayName() }}</span>
                                    </div>
                                </div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="flex items-center text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <div class="flex space-x-3">
                            <a href="{{ route('login') }}" class="text-gray-600 font-medium py-2 px-4 rounded-lg transition-all duration-300 hover:text-pink-600">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="bg-pink-500 text-white font-medium py-2 px-4 rounded-lg transition-all duration-300 hover:bg-pink-600 shadow-sm">
                                {{ __('Register') }}
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:bg-pink-50 hover:text-pink-600 focus:outline-none focus:bg-pink-50 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mobile-menu-bg">
            <div class="pt-2 pb-3 space-y-1">
                <!-- Untuk user biasa -->
                @auth
                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('dashboard') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Dashboard') }}
                        </a>
                    @endif
                @endauth

                <a href="{{ route('packages.index') }}"
                   class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('packages.*') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                    {{ __('Paket') }}
                </a>

                @auth
                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('orders.index') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('orders.*') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Pesanan Saya') }}
                        </a>
                    @endif

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Admin Dashboard') }}
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('admin.users.*') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Kelola User') }}
                        </a>
                        <a href="{{ route('admin.statistics') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('admin.statistics') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Statistik') }}
                        </a>
                        <a href="{{ route('admin.packages.index') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('admin.packages.*') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Kelola Paket') }}
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Responsive Settings Options -->
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full user-avatar flex items-center justify-center mr-3">
                                <span class="text-white font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="text-xs mt-2 {{ Auth::user()->getRoleBadgeColor() }} px-2 py-1 rounded-full inline-block">
                            {{ Auth::user()->getRoleDisplayName() }}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-red-600 hover:bg-red-50 hover:border-red-300 transition-all duration-300 border-transparent">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    {{ __('Log Out') }}
                                </div>
                            </a>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('login') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('login') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}"
                           class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium transition-all duration-300 {{ request()->routeIs('register') ? 'border-pink-500 text-pink-700 bg-pink-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }}">
                            {{ __('Register') }}
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
</body>
</html>
