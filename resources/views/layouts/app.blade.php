<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Learning Management System') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        secondary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @if (auth()->check())
            <nav class="bg-white shadow-lg border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <h1
                                    class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                                    LMS Platform
                                </h1>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden md:block ml-10">
                                <div class="flex items-baseline space-x-4">
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                        <a href="{{ route('admin.mentors') }}"
                                            class="nav-link {{ request()->routeIs('admin.mentors*') ? 'active' : '' }}">
                                            <i class="fas fa-chalkboard-teacher mr-2"></i>Mentors
                                        </a>
                                        <a href="{{ route('admin.courses') }}"
                                            class="nav-link {{ request()->routeIs('admin.courses*') ? 'active' : '' }}">
                                            <i class="fas fa-book mr-2"></i>Courses
                                        </a>
                                    @elseif(auth()->user()->role == 'mentor')
                                        <a href="{{ route('mentor.dashboard') }}"
                                            class="nav-link {{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                    @elseif(auth()->user()->role == 'siswa')
                                        <a href="{{ route('siswa.dashboard') }}"
                                            class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="hidden md:block" x-data="{ open: false }">
                            <div class="ml-4 flex items-center md:ml-6">
                                <div class="relative">
                                    <div>
                                        <button @click="open = !open"
                                            class="flex items-center text-sm rounded-full text-gray-700 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                                            id="user-menu" aria-haspopup="true">
                                            <div
                                                class="h-8 w-8 rounded-full bg-gradient-to-r from-primary-400 to-secondary-400 flex items-center justify-center text-white font-medium">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </div>
                                            <span class="ml-3 font-medium">{{ auth()->user()->name }}</span>
                                            <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                        </button>
                                    </div>
                                    <div x-show="open" @click.away="open = false"
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1" role="menu" aria-orientation="vertical"
                                            aria-labelledby="user-menu">
                                            <div class="px-4 py-2 text-sm text-gray-500 border-b">
                                                {{ ucfirst(auth()->user()->role) }} Account
                                            </div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @endif

        <!-- Flash Messages -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition
                class="bg-green-50 border-l-4 border-green-400 p-4 m-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false" class="text-green-400 hover:text-green-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-transition
                class="bg-red-50 border-l-4 border-red-400 p-4 m-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false" class="text-red-400 hover:text-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="text-center">
                    <p>&copy; 2023 Learning Management System. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>



    
</body>

</html>
