<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kursus Online')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#6366F1',
                        success: '#10B981',
                        danger: '#EF4444',
                        warning: '#F59E0B',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'bounce-soft': 'bounceSoft 2s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    boxShadow: {
                        'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                        'medium': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                        'large': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
                        'glow': '0 0 20px rgba(79, 70, 229, 0.3)',
                        'glow-lg': '0 0 40px rgba(79, 70, 229, 0.4)',
                    }
                },
            },
        };
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceSoft {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateY(-3px);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes glow {
            from {
                box-shadow: 0 0 20px rgba(79, 70, 229, 0.3);
            }

            to {
                box-shadow: 0 0 30px rgba(79, 70, 229, 0.6);
            }
        }

        .dropdown-menu {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top right;
            opacity: 0;
            transform: scale(0.95) translateY(-10px);
        }

        .dropdown-menu.active {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar-item {
            position: relative;
            overflow: hidden;
        }

        .navbar-item::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #4F46E5, #6366F1);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-item:hover::before,
        .navbar-item.active::before {
            width: 100%;
        }

        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen font-sans">
    <!-- Navigation -->
    <nav class="glass-effect sticky top-0 z-50 border-b border-white/20 shadow-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-70 animate-pulse group-hover:animate-glow"></div>
                            <i class="fas fa-graduation-cap text-3xl text-primary relative z-10 group-hover:scale-110 transition-transform duration-300"></i>
                        </div>
                        <span class="text-2xl font-black bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                            eCourse69
                        </span>
                    </a>
                </div>

                <!-- Desktop Navigation Menu -->
                @auth
                <div class="hidden lg:flex items-center space-x-1">
                    @if(Auth::user()->role === 'admin')
                    <!-- Admin Navigation -->
                    <a href="{{ route('admin.dashboard') }}" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-users mr-2"></i>Kelola User
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-book mr-2"></i>Kelola Kursus
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-chart-bar mr-2"></i>Analytics
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-cogs mr-2"></i>Settings
                    </a>
                    @elseif(Auth::user()->role === 'mentor')
                    <!-- Mentor Navigation -->
                    <a href="{{ route('mentor.dashboard') }}" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-book-open mr-2"></i>Kursus Saya
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-user-graduate mr-2"></i>Siswa
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-comments mr-2"></i>Diskusi
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-dollar-sign mr-2"></i>Earnings
                    </a>
                    @elseif(Auth::user()->role === 'student')
                    <!-- Student Navigation -->
                    <a href="{{ route('student.dashboard') }}" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-search mr-2"></i>Jelajahi Kursus
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-play-circle mr-2"></i>Kursus Saya
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-certificate mr-2"></i>Sertifikat
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-heart mr-2"></i>Wishlist
                    </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" class="p-3 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
                @else
                <!-- Guest Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-book mr-2"></i>Kursus
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-users mr-2"></i>Mentor
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-info-circle mr-2"></i>Tentang
                    </a>
                    <a href="#" class="navbar-item px-4 py-2 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300 font-medium">
                        <i class="fas fa-phone mr-2"></i>Kontak
                    </a>
                </div>
                @endauth

                <!-- User Profile / Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button id="profile-dropdown-btn" class="flex items-center space-x-3 px-4 py-3 rounded-2xl bg-white/80 text-gray-700 hover:bg-white hover:text-primary hover:shadow-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary/20 group">
                            <div class="relative">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white animate-bounce-soft"></div>
                            </div>
                            <div class="hidden sm:block text-left">
                                <div class="font-semibold">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300 group-hover:rotate-180" id="dropdown-icon"></i>
                        </button>

                        <div id="profile-dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-3 w-64 bg-white/95 backdrop-blur-xl rounded-3xl shadow-large py-3 z-50 border border-white/20">
                            <!-- Profile Header -->
                            <div class="px-6 py-4 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-primary/10 to-secondary/10 text-primary mt-1 capitalize">
                                            <i class="fas fa-circle text-green-400 text-xs mr-1"></i>
                                            {{ Auth::user()->role }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-2">
                                <a href="#" class="flex items-center px-6 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/10 hover:to-secondary/10 hover:text-primary transition-all duration-200">
                                    <i class="fas fa-user-circle mr-3 text-primary"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <!-- Logout -->
                                <div class="border-t border-gray-100 mt-2 pt-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-6 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200 rounded-b-3xl">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Guest Auth Buttons -->
                    <div class="hidden lg:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary font-semibold transition-colors duration-200 px-4 py-2 rounded-xl hover:bg-primary/5">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-2xl hover:shadow-medium hover:-translate-y-0.5 transition-all duration-300 font-semibold">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </div>

                    <!-- Mobile Menu Button for Guests -->
                    <div class="lg:hidden flex items-center">
                        <button id="mobile-menu-btn" class="p-3 rounded-xl text-gray-700 hover:text-primary hover:bg-primary/5 transition-all duration-300">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="mobile-menu lg:hidden fixed inset-y-0 left-0 w-80 bg-white/95 backdrop-blur-xl shadow-2xl z-50">
            <div class="flex flex-col h-full">
                <!-- Mobile Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">eCourse69</span>
                    </div>
                    <button id="mobile-menu-close" class="p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Mobile Menu Content -->
                <div class="flex-1 overflow-y-auto py-6">
                    @auth
                    <!-- User Info -->
                    <div class="px-6 mb-6">
                        <div class="flex items-center space-x-3 p-4 bg-gradient-to-r from-primary/5 to-secondary/5 rounded-2xl">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Role-based Mobile Menu -->
                    <div class="px-6 space-y-2">
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-3 text-primary"></i>Dashboard
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-users mr-3 text-primary"></i>Kelola User
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-book mr-3 text-primary"></i>Kelola Kursus
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-chart-bar mr-3 text-primary"></i>Analytics
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-cogs mr-3 text-primary"></i>Settings
                        </a>
                        @elseif(Auth::user()->role === 'mentor')
                        <a href="{{ route('mentor.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-3 text-primary"></i>Dashboard
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-book-open mr-3 text-primary"></i>Kursus Saya
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-user-graduate mr-3 text-primary"></i>Siswa
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-comments mr-3 text-primary"></i>Diskusi
                        </a>
                        @elseif(Auth::user()->role === 'student')
                        <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-3 text-primary"></i>Dashboard
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-search mr-3 text-primary"></i>Jelajahi Kursus
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-play-circle mr-3 text-primary"></i>Kursus Saya
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-certificate mr-3 text-primary"></i>Sertifikat
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-heart mr-3 text-primary"></i>Wishlist
                        </a>
                        @endif
                    </div>

                    <!-- Mobile Profile Actions -->
                    <div class="px-6 mt-6 pt-6 border-t border-gray-200 space-y-2">
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-user-circle mr-3 text-primary"></i>Profil Saya
                        </a>
                        <button type="submit" class="flex items-center w-full px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                            <i class="fas fa-sign-out-alt mr-3"></i>Logout
                        </button>
                        </form>
                    </div>
                    @else
                    <!-- Guest Mobile Menu -->
                    <div class="px-6 space-y-2">
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-book mr-3 text-primary"></i>Kursus
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-users mr-3 text-primary"></i>Mentor
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-info-circle mr-3 text-primary"></i>Tentang
                        </a>
                        <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:bg-primary/10 hover:text-primary transition-all duration-200">
                            <i class="fas fa-phone mr-3 text-primary"></i>Kontak
                        </a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="px-6 mt-6 pt-6 border-t border-gray-200 space-y-3">
                        <a href="{{ route('login') }}" class="flex items-center justify-center px-6 py-3 rounded-xl border-2 border-primary text-primary hover:bg-primary hover:text-white transition-all duration-300 font-semibold">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center px-6 py-3 rounded-xl bg-gradient-to-r from-primary to-secondary text-white hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-semibold">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu-overlay" class="lg:hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden"></div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
        <!-- Flash Messages -->
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl shadow-soft animate-slide-up" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                    <button class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl shadow-soft animate-slide-up" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">{{ session('error') }}</p>
                    </div>
                    <button class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="animate-fade-in">
            @yield('content')
        </div>
    </main>

    <!-- Enhanced Footer -->
    <footer class="bg-gradient-to-br from-gray-900 to-black text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-white/[0.02] bg-[size:50px_50px]"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">eCourse69</span>
                    </div>
                    <p class="text-white/80 text-lg leading-relaxed mb-8 max-w-md">
                        Platform pembelajaran online terdepan yang menghadirkan transformasi karier melalui pendidikan berkualitas tinggi dan teknologi inovatif.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <i class="fab fa-facebook text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <i class="fab fa-linkedin text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center hover:bg-white/20 transition-all duration-300 hover:scale-110">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Quick Links</h3>
                    <div class="space-y-3">
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Tentang Kami</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Karier</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Blog</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Press Kit</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Partnership</a>
                    </div>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Support</h3>
                    <div class="space-y-3">
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Help Center</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Contact Support</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Privacy Policy</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Terms of Service</a>
                        <a href="#" class="block text-white/70 hover:text-white transition-colors duration-200">Refund Policy</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/20 pt-8 mt-12">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-white/70">&copy; 2025 eCourse69. All rights reserved.</p>
                    <div class="flex items-center space-x-6">
                        <span class="text-white/70 text-sm">Made with</span>
                        <i class="fas fa-heart text-red-400 animate-pulse"></i>
                        <span class="text-white/70 text-sm">in Jakarta, Indonesia</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile Dropdown
            const dropdownBtn = document.getElementById('profile-dropdown-btn');
            const dropdownMenu = document.getElementById('profile-dropdown-menu');
            const dropdownIcon = document.getElementById('dropdown-icon');

            // Mobile Menu
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

            // Toggle profile dropdown function
            const toggleDropdown = () => {
                if (!dropdownMenu) return;
                const isHidden = dropdownMenu.classList.contains('hidden');
                if (isHidden) {
                    dropdownMenu.classList.remove('hidden');
                    setTimeout(() => {
                        dropdownMenu.classList.add('active');
                        if (dropdownIcon) dropdownIcon.classList.add('rotate-180');
                    }, 10);
                } else {
                    dropdownMenu.classList.remove('active');
                    if (dropdownIcon) dropdownIcon.classList.remove('rotate-180');
                    setTimeout(() => {
                        dropdownMenu.classList.add('hidden');
                    }, 300);
                }
            };

            // Toggle mobile menu function
            const toggleMobileMenu = () => {
                if (!mobileMenu || !mobileMenuOverlay) return;
                const isOpen = mobileMenu.classList.contains('open');
                if (isOpen) {
                    mobileMenu.classList.remove('open');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                } else {
                    mobileMenu.classList.add('open');
                    mobileMenuOverlay.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            };

            // Event listeners
            if (dropdownBtn) {
                dropdownBtn.addEventListener('click', toggleDropdown);
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleMobileMenu);
            }

            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', toggleMobileMenu);
            }

            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', toggleMobileMenu);
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (dropdownBtn && dropdownMenu && !dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    if (!dropdownMenu.classList.contains('hidden')) {
                        dropdownMenu.classList.remove('active');
                        if (dropdownIcon) dropdownIcon.classList.remove('rotate-180');
                        setTimeout(() => {
                            dropdownMenu.classList.add('hidden');
                        }, 300);
                    }
                }
            });

            // Close mobile menu on escape key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('open')) {
                    toggleMobileMenu();
                }
            });

            // Auto-hide flash messages after 5 seconds
            const flashMessages = document.querySelectorAll('[role="alert"]');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        message.remove();
                    }, 300);
                }, 5000);
            });

            // Add active class to current page nav item
            const currentPath = window.location.pathname;
            const navItems = document.querySelectorAll('.navbar-item');
            navItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>