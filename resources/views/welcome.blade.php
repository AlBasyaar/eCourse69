@extends('layouts.app')

@section('title', 'Welcome - eCourse69')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white overflow-hidden">
    <!-- Background Ellipses -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-300 rounded-full filter blur-3xl opacity-50 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-100 rounded-full filter blur-3xl opacity-60 translate-x-1/3 translate-y-1/3"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                <span class="text-gray-900">PILIHAN TERBAIK UNTUK</span>
                <br>
                <span class="text-blue-600">MENINGKATKAN SKILL ANDA!</span>
            </h1>

            <p class="text-base md:text-lg text-gray-600 max-w-3xl mx-auto mb-12">
                Jelajahi berbagai kursus di bidang Desain Grafis, Pemrograman, dan IT NSA untuk meraih karier impian Anda.
            </p>

            @guest
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                    Mulai Belajar Sekarang
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-blue-600 bg-white border-2 border-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </a>
            </div>
            @else
            <div class="flex justify-center">
                @if(Auth::user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:shadow-lg">
                    Dashboard Siswa
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                @elseif(Auth::user()->role === 'mentor')
                <a href="{{ route('mentor.dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 hover:shadow-lg">
                    Dashboard Mentor
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-red-500 to-red-600 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-300 hover:shadow-lg">
                    Dashboard Admin
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                @endif
            </div>
            @endguest
        </div>
    </div>
</div>

<!-- Category Tabs -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto lg:justify-center space-x-8 py-4">
            <button class="whitespace-nowrap text-white-500 pb-2 font-medium text-sm">
                Sistem Informasi Jaringan dan Aplikasi
            </button>
            <button class="whitespace-nowrap text-[#3b82f6] hover:text-[#60a5fa] pb-2 font-medium text-sm">
                Sistem Informasi Jaringan dan Aplikasi
            </button>
            <button class="whitespace-nowrap text-white-500 hover:text-white-700 pb-2 font-medium text-sm">
                Sistem Informasi Jaringan dan Aplikasi
            </button>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="py-16 bg-white relative overflow-hidden">
    <!-- Background Ellipses -->
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-200 rounded-full filter blur-3xl opacity-50 translate-x-1/3 translate-y-1/2"></div>
    <div class="absolute top-1/2 right-10 w-64 h-64 bg-white rounded-full filter blur-2xl opacity-70"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            <span class="text-blue-400">eCourse69</span>
        </h2>
        <p class="text-base text-gray-700 max-w-3xl mx-auto leading-relaxed">
            <strong>eCourse69</strong> adalah platform pembelajaran daring yang menyediakan kursus berkualitas tinggi membantu pengguna menguasai keterampilan praktis yang dibutuhkan di dunia kerja.
        </p>
    </div>
</div>

<!-- Course Categories -->
<div class="py-16 bg-white">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">
            List <span class="text-blue-400">Bidang</span>
        </h2>

        <!-- Section: Skills -->
        <div class="relative max-w-5xl mx-auto mt-16">
            <!-- Garis penghubung (SVG) -->
            <div class="hidden md:block absolute left-0 right-0 top-[60px]">
                <svg class="w-full h-1" viewBox="0 0 1000 2" preserveAspectRatio="none">
                    <line x1="150" y1="1" x2="850" y2="1" stroke="#E5E7EB" stroke-width="2" stroke-dasharray="8,8" />
                </svg>
            </div>

            <!-- Grid konten -->
            <div class="grid md:grid-cols-3 gap-8 relative z-10">
                <!-- Programming -->
                <div class="text-center group relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-md mb-6 border-2 border-gray-300 group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-code text-4xl text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">PROGRAMMING</h3>
                    <p class="text-sm text-gray-600 mb-4">Web Development, Mobile App</p>
                </div>

                <!-- Design -->
                <div class="text-center group relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-md mb-6 border-2 border-gray-300 group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-pen-nib text-4xl text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">DESAIN</h3>
                    <p class="text-sm text-gray-600 mb-4">UI/UX Desain, Desain Grafis</p>
                </div>

                <!-- Networking -->
                <div class="text-center group relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-md mb-6 border-2 border-gray-300 group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-network-wired text-4xl text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">NETWORKING</h3>
                    <p class="text-sm text-gray-600 mb-4">Jaringan komputer, keamanan siber</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="py-16 bg-white relative overflow-hidden">
    <!-- Background Ellipses -->
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-200 rounded-full filter blur-3xl opacity-50 -translate-x-1/3 translate-y-1/2"></div>
    <div class="absolute top-1/3 left-20 w-72 h-72 bg-white rounded-full filter blur-2xl opacity-60"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">
            Mengapa <span class="text-blue-400">eCourse69?</span>
        </h2>

        <div class="grid md:grid-cols-4 gap-6 mt-12">
            <!-- Testimonial 1 - White Card -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-3xl p-6 text-center shadow-md hover:shadow-lg transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full mb-6">
                    <span class="text-2xl font-bold text-white-400">01</span>
                </div>
                <h3 class="text-base font-bold text-white mb-2">Muhammad Bintang</h3>
                <p class="text-sm font-semibold text-white/900 mb-3">Web Developer</p>
                <p class="text-xs text-white/800">Materi sangat mudah dipahami dan mentornya sangat membantu!</p>
            </div>

            <!-- Testimonial 2 - Blue Card -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-3xl p-6 text-center shadow-md hover:shadow-lg transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full mb-6">
                    <span class="text-2xl font-bold text-white">02</span>
                </div>
                <h3 class="text-base font-bold text-white mb-2">Haikal Devin Prayata</h3>
                <p class="text-sm font-semibold text-white/90 mb-3">Networking</p>
                <p class="text-xs text-white/80">Berkat e-Course69, saya berhasil mendapatkan pekerjaan pertama sebagai desainer grafis.</p>
            </div>

            <!-- Testimonial 3 - Blue Card -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-3xl p-6 text-center shadow-md hover:shadow-lg transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full mb-6">
                    <span class="text-2xl font-bold text-white">03</span>
                </div>
                <h3 class="text-base font-bold text-white mb-2">Muhamad ilman Az Zaidan</h3>
                <p class="text-sm font-semibold text-white/90 mb-3">Desainer Grafis</p>
                <p class="text-xs text-white/80">Berkat e-Course69, saya berhasil mendapatkan pekerjaan pertama sebagai desainer grafis.</p>
            </div>

            <!-- Testimonial 4 - Blue Card -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-3xl p-6 text-center shadow-md hover:shadow-lg transition-all duration-300">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/30 backdrop-blur-sm rounded-full mb-6">
                    <span class="text-2xl font-bold text-white">04</span>
                </div>
                <h3 class="text-base font-bold text-white mb-2">Serli Santiono</h3>
                <p class="text-sm font-semibold text-white/90 mb-3">MARKETING</p>
                <p class="text-xs text-white/80">Platform yang bagus untuk belajar skill baru dengan fleksibel.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer Info -->
<div id="footer" class="relative bg-white py-12 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Blue rounded container with shadow -->
        <div class="bg-gradient-to-br rounded-[4rem] shadow-2xl px-16 py-20 relative overflow-visible">

            <div class="relative grid md:grid-cols-2 gap-16 items-center">
                <div class="text-white">
                    <h2 class="text-4xl md:text-5xl font-bold mb-8">eCourse69</h2>
                    <p class="text-white/95 leading-relaxed text-base md:text-lg">
                        e-Course69 adalah platform pembelajaran daring yang menyediakan kursus berkualitas tinggi membantu pengguna menguasai keterampilan praktis yang dibutuhkan di dunia kerja.
                    </p>
                </div>

                <div class="text-white space-y-6">
                    <!-- Instagram -->
                    <div class="flex items-center space-x-5">
                        <a href="https://www.instagram.com/smknegeri69jakarta" target="_blank" class="flex items-center space-x-5 hover:opacity-80 transition">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md"
                                style="background-color: #ffffff !important;">
                                <i class="fab fa-instagram text-blue-500 text-2xl"></i>
                            </div>
                            <span class="text-base md:text-lg">@smknegeri69jakarta</span>
                        </a>
                    </div>

                    <!-- Website -->
                    <div class="flex items-center space-x-5">
                        <a href="https://smkn69jkt.sch.id/" target="_blank" class="flex items-center space-x-5 hover:opacity-80 transition">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md"
                                style="background-color: #ffffff !important;">
                                <i class="fas fa-globe text-blue-500 text-2xl"></i>
                            </div>
                            <span class="text-base md:text-lg">smkn69jkt.sch.id</span>
                        </a>
                    </div>

                    <!-- YouTube -->
                    <div class="flex items-center space-x-5">
                        <a href="https://www.youtube.com/@smkn69jakarta25" target="_blank" class="flex items-center space-x-5 hover:opacity-80 transition">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 shadow-md"
                                style="background-color: #ffffff !important;">
                                <i class="fab fa-youtube text-blue-500 text-2xl"></i>
                            </div>
                            <span class="text-base md:text-lg">SMKN 69 Jakarta</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection