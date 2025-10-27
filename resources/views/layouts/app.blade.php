<!DOCTYPE html>
<html lang="en" id="html-root">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'eCourse69')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'outfit', sans-serif;
            background-color: #111827;
            color: #f9fafb;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode Variables */
        body {
            --bg-primary: #111827;
            --bg-secondary: #1f2937;
            --bg-tertiary: #374151;
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --text-tertiary: #9ca3af;
            --border-color: #374151;
            --navbar-bg: rgba(31, 41, 55, 0.95);
            --card-bg: #1f2937;
            --input-bg: #374151;
            --hover-bg: #374151;
        }

        /* Headings */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #f9fafb;
        }

        /* Paragraphs and Text */
        p,
        span,
        div {
            color: #f9fafb;
        }

        /* Cards */
        .card,
        [class*="bg-white"]:not(.bg-white\/5):not(.bg-white\/10) {
            background-color: #1f2937 !important;
            color: #f9fafb !important;
        }

        /* Tables */
        table {
            color: #f9fafb;
        }

        th {
            background-color: #374151;
            color: #f9fafb;
        }

        td {
            border-color: #374151;
            color: #f9fafb;
        }

        /* Forms */
        input,
        textarea,
        select {
            background-color: #374151;
            color: #f9fafb;
            border-color: #4b5563;
        }

        input::placeholder,
        textarea::placeholder {
            color: #6b7280;
        }

        /* Labels */
        label {
            color: #d1d5db;
        }

        /* Button Visibility */
        button,
        .btn {
            opacity: 1 !important;
            visibility: visible !important;
        }

        /* Action Buttons */
        .bg-blue-500,
        .bg-blue-600,
        button.bg-blue-500,
        button.bg-blue-600,
        a.bg-blue-500,
        a.bg-blue-600 {
            background-color: #2563eb !important;
            color: #ffffff !important;
            border: 1px solid #2563eb !important;
        }

        .bg-green-500,
        .bg-green-600,
        button.bg-green-500,
        button.bg-green-600 {
            background-color: #16a34a !important;
            color: #ffffff !important;
            border: 1px solid #16a34a !important;
        }

        .bg-red-500,
        .bg-red-600,
        button.bg-red-500,
        button.bg-red-600 {
            background-color: #dc2626 !important;
            color: #ffffff !important;
            border: 1px solid #dc2626 !important;
        }

        .bg-yellow-500,
        .bg-yellow-600,
        button.bg-yellow-500,
        button.bg-yellow-600 {
            background-color: #ca8a04 !important;
            color: #ffffff !important;
            border: 1px solid #ca8a04 !important;
        }

        .bg-purple-500,
        .bg-purple-600 {
            background-color: #9333ea !important;
            color: #ffffff !important;
            border: 1px solid #9333ea !important;
        }

        /* Hover Effects for Buttons */
        .bg-blue-600:hover,
        button.bg-blue-600:hover {
            background-color: #1d4ed8 !important;
            border-color: #1d4ed8 !important;
        }

        .bg-green-600:hover,
        button.bg-green-600:hover {
            background-color: #15803d !important;
            border-color: #15803d !important;
        }

        .bg-red-600:hover,
        button.bg-red-600:hover {
            background-color: #b91c1c !important;
            border-color: #b91c1c !important;
        }

        /* Icon Buttons */
        .text-blue-600 {
            color: #2563eb !important;
        }

        .text-green-600 {
            color: #16a34a !important;
        }

        .text-red-600 {
            color: #dc2626 !important;
        }

        .text-yellow-600 {
            color: #ca8a04 !important;
        }

        /* Form Buttons */
        button[type="submit"],
        button[type="button"],
        input[type="submit"] {
            opacity: 1 !important;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1) !important;
        }

        .navbar-glass {
            background: var(--navbar-bg);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }

        .dropdown-menu {
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.2s, transform 0.2s;
            pointer-events: none;
        }

        .dropdown-menu.active {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }

        /* Specific fixes for Tailwind classes */
        .text-gray-900 {
            color: #f9fafb !important;
        }

        .text-gray-800 {
            color: #f9fafb !important;
        }

        .text-gray-700 {
            color: #d1d5db !important;
        }

        .text-gray-600 {
            color: #9ca3af !important;
        }

        .dark\:text-white,
        .dark\:text-gray-200,
        .dark\:text-gray-300 {
            color: #f9fafb !important;
        }

        /* Border colors */
        [class*="border-gray"] {
            border-color: #4b5563 !important;
        }

        /* Background fix for secondary elements */
        .bg-gray-50 {
            background-color: #374151 !important;
        }

        .bg-gray-100 {
            background-color: #4b5563 !important;
        }

        /* Hover states */
        .hover\:bg-gray-700:hover {
            background-color: #374151 !important;
        }

        /* Ensure all action links are visible */
        a[href*="edit"],
        a[href*="delete"],
        a[href*="create"],
        a[href*="add"] {
            opacity: 1 !important;
        }

        /* Contact Button Styles */
        .contact-btn {
            background-color: #000000;
            color: #f9fafb;
        }

        .contact-btn:hover {
            background-color: #ffffff;
            color: #000000;
        }
    </style>
</head>

<body class="dark-mode">
    <!-- Navbar -->
    <nav class="navbar-glass sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <img src="https://res.cloudinary.com/dr5pehdsw/image/upload/v1760316641/logo_e_course_revisi-01_kxfe5e.png"
                            alt="eCourse69 Logo" class="w-38 h-24 rounded-lg">
                    </a>
                </div>

                <!-- Center - Clock & Location (Desktop) -->
                <div class="hidden lg:flex items-center space-x-6">
                    <div class="flex items-center space-x-2 text-sm">
                        <i class="far fa-clock"></i>
                        <span id="realtime-clock">00:00:00</span>
                    </div>
                    <div class="h-4 w-px bg-gray-300"></div>
                    <div class="flex items-center space-x-2 text-sm">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Waktu Indonesia Barat</span>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    @guest
                        <!-- Login & Register Buttons -->
                        <div class="hidden md:flex items-center space-x-3">
                            <a href="{{ route('login') }}"
                                class="px-6 py-2 text-sm font-medium hover:text-blue-600 transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all">
                                Register
                            </a>
                        </div>

                        <!-- Mobile Menu Button (Guest) -->
                        <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg">
                            <i class="fas fa-bars"></i>
                        </button>
                    @else
                        <!-- User Menu (Authenticated) -->
                        <div class="hidden md:flex items-center space-x-4">
                            <!-- Nav Links based on role -->
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="px-3 py-2 text-sm font-medium hover:text-blue-600 transition-colors">Dashboard</a>
                            @elseif(Auth::user()->role === 'mentor')
                                <a href="{{ route('mentor.dashboard') }}"
                                    class="px-3 py-2 text-sm font-medium hover:text-blue-600 transition-colors">Dashboard</a>
                            @elseif(Auth::user()->role === 'student')
                                <a href="{{ route('student.dashboard') }}"
                                    class="px-3 py-2 text-sm font-medium hover:text-blue-600 transition-colors">Dashboard</a>
                            @endif

                            <!-- Profile Dropdown -->
                            <div class="relative">
                                <button id="profile-btn"
                                    class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                                </button>

                                <div id="profile-dropdown"
                                    class="dropdown-menu absolute right-0 mt-2 w-56 rounded-lg shadow-lg border py-2"
                                    style="background-color: var(--card-bg); border-color: var(--border-color);">
                                    <div class="px-4 py-3 border-b" style="border-color: var(--border-color);">
                                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                                        <p class="text-xs" style="color: var(--text-tertiary);">{{ Auth::user()->email }}
                                        </p>
                                    </div>
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm hover:bg-gray-700">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="border-t mt-2 pt-2"
                                        style="border-color: var(--border-color);">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-900/20">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Menu Button (Authenticated) -->
                        <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-bars"></i>
                        </button>
                    @endauth

                </div>
            </div>

            <!-- Mobile Clock & Location -->
            <div class="lg:hidden flex items-center justify-center space-x-4 py-2 border-t"
                style="border-color: var(--border-color);">
                <div class="flex items-center space-x-2 text-xs">
                    <i class="far fa-clock"></i>
                    <span id="realtime-clock-mobile">00:00:00</span>
                </div>
                <div class="h-3 w-px bg-gray-300"></div>
                <div class="text-xs">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    WIB
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu" class="mobile-menu fixed inset-y-0 left-0 w-64 shadow-xl z-50 overflow-y-auto"
        style="background-color: var(--card-bg);">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <span class="text-xl font-bold">Menu</span>
                <button id="mobile-menu-close" class="p-2 rounded-lg">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @guest
                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-3 text-center border rounded-lg hover:bg-gray-700"
                        style="border-color: var(--border-color);">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-3 text-center text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg">
                        Register
                    </a>
                </div>
            @else
                <div class="space-y-2">
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    @elseif(Auth::user()->role === 'mentor')
                        <a href="{{ route('mentor.dashboard') }}" class="block px-4 py-3 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    @elseif(Auth::user()->role === 'student')
                        <a href="{{ route('student.dashboard') }}" class="block px-4 py-3 hover:bg-gray-700 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                        </a>
                    @endif

                    <a href="#" class="block px-4 py-3 hover:bg-gray-700 rounded-lg">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t"
                        style="border-color: var(--border-color);">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-3 text-red-600 hover:bg-red-900/20 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            @endguest
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 hidden"></div>

    <!-- Main Content -->
    <main>
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-green-900/20 border border-green-800 text-green-200 px-6 py-4 rounded-lg shadow-sm"
                    role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="font-medium">{{ session('success') }}</p>
                        <button onclick="this.parentElement.parentElement.remove()"
                            class="ml-auto text-green-500 hover:text-green-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-red-900/20 border border-red-800 text-red-200 px-6 py-4 rounded-lg shadow-sm"
                    role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                        <p class="font-medium">{{ session('error') }}</p>
                        <button onclick="this.parentElement.parentElement.remove()"
                            class="ml-auto text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
        
    </main>

    @yield('scripts')

    <script>
        // Real-time Clock Function
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;

            const clockElement = document.getElementById('realtime-clock');
            const clockMobileElement = document.getElementById('realtime-clock-mobile');

            if (clockElement) clockElement.textContent = timeString;
            if (clockMobileElement) clockMobileElement.textContent = timeString;
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock(); // Initial call

        // Profile Dropdown
        const profileBtn = document.getElementById('profile-btn');
        const profileDropdown = document.getElementById('profile-dropdown');

        if (profileBtn && profileDropdown) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });
        }

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

        function toggleMobileMenu() {
            mobileMenu.classList.toggle('open');
            mobileMenuOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
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

        // Auto-hide flash messages
        setTimeout(() => {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                alert.style.transition = 'all 0.3s ease';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>

</html>
