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
                    },
                    boxShadow: {
                        'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
                        'medium': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
                        'large': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
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
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .hero-pattern {
            background-image: radial-gradient(circle at 25px 25px, rgba(255, 255, 255, 0.1) 2px, transparent 0),
                radial-gradient(circle at 75px 75px, rgba(255, 255, 255, 0.1) 2px, transparent 0);
            background-size: 100px 100px;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 min-h-screen font-sans">
    <!-- Navigation -->
    <nav class="glass-effect sticky top-0 z-50 border-b border-white/20 shadow-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-3 hover-lift">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-full blur opacity-70 animate-pulse"></div>
                            <i class="fas fa-graduation-cap text-2xl text-primary relative z-10"></i>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                            Kursus Online
                        </span>
                    </a>
                </div>

                @auth
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button id="profile-dropdown-btn" class="flex items-center space-x-3 px-4 py-2 rounded-xl bg-white/80 text-gray-700 hover:bg-white hover:text-primary hover:shadow-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <div class="relative">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white animate-bounce-soft"></div>
                            </div>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300" id="dropdown-icon"></i>
                        </button>
                        <div id="profile-dropdown-menu" class="dropdown-menu hidden absolute right-0 mt-3 w-56 bg-white/95 backdrop-blur-xl rounded-2xl shadow-large py-2 z-50 border border-white/20">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gradient-to-r hover:from-primary/10 hover:to-secondary/10 hover:text-primary transition-all duration-200">
                                <i class="fas fa-user-circle mr-3 text-primary"></i>
                                <span>Profil Saya</span>
                            </a>
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200 rounded-b-2xl">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary font-medium transition-colors duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-xl hover:shadow-medium hover:-translate-y-0.5 transition-all duration-300 font-medium">
                        Register
                    </a>
                </div>
                @endauth
            </div>
        </div>
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
                </div>
            </div>
        </div>
        @endif

        <div class="animate-fade-in">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="mb-6">
                    <div class="flex items-center justify-center space-x-3 mb-4">
                        <i class="fas fa-graduation-cap text-3xl text-black"></i>
                        <span class="text-2xl font-bold text-black">Kursus Online</span>
                    </div>
                    <p class="text-black/80 text-lg">
                        Platform pembelajaran online terbaik untuk masa depan yang cerah
                    </p>
                </div>
                <div class="border-t border-black/20 pt-6">
                    <p class="text-black/70">&copy; 2025 Kursus Online. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.getElementById('profile-dropdown-btn');
            const dropdownMenu = document.getElementById('profile-dropdown-menu');
            const dropdownIcon = document.getElementById('dropdown-icon');

            // Toggle dropdown function
            const toggleDropdown = () => {
                const isHidden = dropdownMenu.classList.contains('hidden');
                if (isHidden) {
                    dropdownMenu.classList.remove('hidden');
                    setTimeout(() => {
                        dropdownMenu.classList.add('active');
                        dropdownIcon.classList.add('rotate-180');
                    }, 10);
                } else {
                    dropdownMenu.classList.remove('active');
                    dropdownIcon.classList.remove('rotate-180');
                    setTimeout(() => {
                        dropdownMenu.classList.add('hidden');
                    }, 300);
                }
            };

            // Close dropdown when clicking outside
            document.addEventListener('click', (event) => {
                if (!dropdownBtn || !dropdownMenu) return;
                if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    if (!dropdownMenu.classList.contains('hidden')) {
                        dropdownMenu.classList.remove('active');
                        dropdownIcon.classList.remove('rotate-180');
                        setTimeout(() => {
                            dropdownMenu.classList.add('hidden');
                        }, 300);
                    }
                }
            });

            // Toggle dropdown on button click
            if (dropdownBtn) {
                dropdownBtn.addEventListener('click', toggleDropdown);
            }

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
        });
    </script>
</body>

</html>