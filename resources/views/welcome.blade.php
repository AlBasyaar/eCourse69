@extends('layouts.app')

@section('title', 'Welcome - eCourse69')

@section('content')
<!-- Hero Section -->
<div class="relative from-blue-50 dark:from-gray-900 via-white dark:via-black to-purple-50 dark:to-purple-900/30 overflow-hidden">
<div class="absolute top-0 left-0 w-64 h-64 bg-blue-200 dark:bg-blue-900 rounded-full filter blur-3xl opacity-20 dark:opacity-40 animate-blob"></div>
<div class="absolute bottom-0 right-0 w-64 h-64 bg-purple-200 dark:bg-purple-900 rounded-full filter blur-3xl opacity-20 dark:opacity-40 animate-blob animation-delay-2000"></div>



    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
                <span class="text-gray-900 dark:text-gray-100">PILIHAN TERBAIK UNTUK</span>
                <br>
                <span class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-400 dark:to-blue-500 bg-clip-text text-transparent">MENINGKATKAN SKILL ANDA!</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-12">
                Jelajahi berbagai kursus di bidang Desain Grafis, Pemrograman, dan IT NSA untuk meraih karier impian Anda.
            </p>

            @guest
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                    Mulai Belajar Sekarang
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-blue-600 bg-white border-2 border-blue-600 rounded-lg hover:bg-blue-50 transition-all duration-300 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-500 dark:hover:bg-gray-700">
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
<div class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex overflow-x-auto lg:justify-center space-x-8 py-4">
            <button class="whitespace-nowrap text-blue-600 border-b-2 border-blue-600 pb-2 font-medium">
                Sistem Informasi Jaringan dan Aplikasi
            </button>
            <button class="whitespace-nowrap text-gray-500 hover:text-gray-700 pb-2 font-medium">
                Desain Grafis & Multimedia
            </button>
            <button class="whitespace-nowrap text-gray-500 hover:text-gray-700 pb-2 font-medium">
                Programming & Development
            </button>
        </div>
    </div>
</div>

<!-- Video Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-400 to-blue-500 rounded-3xl p-12 text-center shadow-xl">
            <div class="flex items-center justify-center h-64">
                <div class="text-white">
                    <i class="fas fa-play-circle text-6xl mb-4"></i>
                    <h3 class="text-2xl md:text-3xl font-bold">Video Mengenai Webnya, Bidangnya, fotonya</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            <span class="bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent">eCourse69</span>
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            eCourse69 adalah platform pembelajaran dengan yang menyediakan kursus berkualitas tinggi membantu pengguna menguasai keterampilan praktis yang dibutuhkan di dunia kerja.
        </p>
    </div>
</div>

<!-- Course Categories -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">
            <span class="bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent">List Bidang</span>
        </h2>

        <!-- Section: Skills -->
        <div class="relative max-w-5xl mx-auto mt-16">
            <!-- Garis penghubung (SVG) -->
            <div class="hidden md:block absolute left-0 right-0 top-[60px]">
                <!-- top-[60px] = posisi sejajar dengan pusat lingkaran (karena lingkaran tinggi 96px / w-24 h-24) -->
                <svg class="w-full h-1" viewBox="0 0 1000 2" preserveAspectRatio="none">
                    <line x1="150" y1="1" x2="850" y2="1" stroke="#E5E7EB" stroke-width="2" stroke-dasharray="8,8" />
                </svg>
            </div>

            <!-- Grid konten -->
            <div class="grid md:grid-cols-3 gap-8 relative z-10">
                <!-- Programming -->
                <div class="text-center group relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg mb-6 border border-gray-200 group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-code text-4xl text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">PROGRAMMING</h3>
                    <p class="text-sm text-gray-600">Web Development, Mobile App</p>
                </div>

                <!-- Design -->
                <div class="text-center group relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-500 rounded-full shadow-lg mb-6 border border-blue-300 group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-pen-nib text-4xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent mb-2">DESAIN</h3>
                    <p class="text-sm text-gray-600">UI/UX Desain, Desain Grafis</p>
                </div>

                <!-- Networking -->
                <div class="text-center group relative">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-lg mb-6 border border-gray-200 group-hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-network-wired text-4xl text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">NETWORKING</h3>
                    <p class="text-sm text-gray-600">Jaringan komputer, keamanan siber</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-4">
            Mengapa <span class="bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent">eCourse69?</span>
        </h2>

        <div class="grid md:grid-cols-3 gap-8 mt-12">
            <!-- Testimonial 1 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6">
                    <span class="text-2xl font-bold text-blue-600">01</span>
                </div>
                <h3 class="text-lg font-bold bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent mb-2">Wahyu Andika Rahadi</h3>
                <p class="text-sm font-semibold text-gray-900 mb-3">Web Developer</p>
                <p class="text-sm text-gray-600">Materi sangat mudah dipahami dan mentornya sangat membantu!</p>
            </div>

            <!-- Testimonial 2 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-6">
                    <span class="text-2xl font-bold text-white">02</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Naya Refa Muhaemin </h3>
                <p class="text-sm font-semibold text-gray-900 mb-3">Desainer Grafis</p>
                <p class="text-sm text-gray-600">Berkat e-Course69, saya berhasil mendapatkan pekerjaan pertama sebagai desainer grafis.</p>
            </div>

            <!-- Testimonial 3 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6">
                    <span class="text-2xl font-bold text-blue-600">03</span>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Haikal Devin Prayata</h3>
                <p class="text-sm font-semibold text-gray-900 mb-3">NETWORKING</p>
                <p class="text-sm text-gray-600">Materinya gampang dipahami, cocok buat pemula.</p>
            </div>
        </div>

        <!-- Pagination Dots -->
        <div class="flex justify-center mt-8 space-x-2">
            <button class="w-2 h-2 bg-gray-400 rounded-full"></button>
            <button class="w-2 h-2 bg-blue-600 rounded-full"></button>
            <button class="w-2 h-2 bg-gray-400 rounded-full"></button>
        </div>
    </div>
</div>

<!-- Footer Info -->
<div class="bg-gradient-to-r from-blue-400 to-blue-500 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="text-white">
                <h2 class="text-3xl font-bold mb-6">eCourse69</h2>
                <p class="text-blue-50 leading-relaxed mb-6">
                    e-Course69 adalah platform pembelajaran online yang menyediakan kursus berkualitas tinggi untuk membantu pengguna menguasai keterampilan praktis yang dibutuhkan di dunia kerja.
                </p>
            </div>

            <div class="text-white space-y-4">
                <div class="flex items-center space-x-3">
                    <i class="fab fa-instagram text-2xl"></i>
                    <span>@smkn68jkt/69jakarta</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-globe text-2xl"></i>
                    <span>smkn69jkt.sch.id/</span>
                </div>
                <div class="flex items-center space-x-3">
                    <i class="fab fa-youtube text-2xl"></i>
                    <span>SMKN 69 Jakarta</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Final CTA -->
<div class="bg-white py-20">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-5xl md:text-7xl font-black mb-4">
            <span class="text-gray-900">ENAM</span>
            <span class="bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent"> SEMBILAN</span>
        </h2>
        <p class="text-xl text-gray-600"><cite>Wujudkan Karier Impianmu Bersama Kami</cite> </p>
    </div>
</div>

<style>
    @keyframes blob {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>
@endsection