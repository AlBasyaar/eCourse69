<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome - Learning Management System</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <!-- Navigation -->
        <nav class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                            LMS Platform
                        </h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if(auth()->check())
                            <a href="@if(auth()->user()->role == 'admin'){{ route('admin.dashboard') }}@elseif(auth()->user()->role == 'mentor'){{ route('mentor.dashboard') }}@else{{ route('siswa.dashboard') }}@endif" 
                               class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 px-3 py-2 rounded-md transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                Register
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative bg-gradient-to-br from-primary-50 via-white to-secondary-50">
            <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                        Master New Skills with 
                        <span class="bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">
                            Expert Guidance
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Join our comprehensive learning management system and unlock your potential with personalized mentorship, 
                        interactive courses, and hands-on projects.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="bg-primary-600 text-white px-8 py-4 rounded-xl hover:bg-primary-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-rocket mr-2"></i>Start Learning Today
                        </a>
                        <a href="#features" class="bg-white text-primary-600 px-8 py-4 rounded-xl border-2 border-primary-600 hover:bg-primary-50 transition-all duration-300">
                            <i class="fas fa-info-circle mr-2"></i>Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Our Platform?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Experience a revolutionary way of learning with cutting-edge features designed for your success.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="group bg-gradient-to-br from-primary-50 to-primary-100 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-primary-600 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-user-graduate text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Expert Mentorship</h3>
                    <p class="text-gray-600">Learn from industry professionals with years of experience and get personalized guidance.</p>
                </div>

                <div class="group bg-gradient-to-br from-secondary-50 to-secondary-100 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-secondary-600 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-video text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Interactive Courses</h3>
                    <p class="text-gray-600">Engage with high-quality video content, assignments, and real-world projects.</p>
                </div>

                <div class="group bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-16 h-16 bg-purple-600 rounded-xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-certificate text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Certification</h3>
                    <p class="text-gray-600">Earn recognized certificates upon course completion to boost your career prospects.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-r from-primary-600 to-secondary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">1000+</div>
                    <div class="text-primary-100">Students Enrolled</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-primary-100">Expert Mentors</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">100+</div>
                    <div class="text-primary-100">Courses Available</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">95%</div>
                    <div class="text-primary-100">Success Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Transform Your Future?</h2>
            <p class="text-gray-600 mb-8 text-lg">Join thousands of learners who have already started their journey to success.</p>
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-8 py-4 rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg font-medium">
                <i class="fas fa-arrow-right mr-2"></i>Get Started Now
            </a>
        </div>
    </section>

    <style>
        .bg-grid-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.4'%3E%3Ccircle cx='5' cy='5' r='5'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</body>
</html>