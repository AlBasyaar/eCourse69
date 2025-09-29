@extends('layouts.app')

@section('title', 'Welcome - Kursus Online')

@section('content')
<!-- Hero Section with Modern Design -->
<div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Geometric Patterns -->
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="text-center">
            <div class="mb-8">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white/10 text-white backdrop-blur-sm border border-white/20">
                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                    Platform Pembelajaran #1 di Indonesia
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold mb-8 leading-tight">
                <span class="bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent">
                    Masa Depan
                </span>
                <br>
                <span class="bg-gradient-to-r from-yellow-300 via-orange-300 to-pink-300 bg-clip-text text-transparent">
                    Dimulai Hari Ini
                </span>
            </h1>

            <p class="text-xl md:text-2xl mb-12 text-white/90 max-w-3xl mx-auto leading-relaxed">
                Bergabunglah dengan ribuan profesional sukses yang telah mengubah karier mereka melalui pembelajaran berkualitas tinggi di eCourse69
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                @guest
                <a href="{{ route('register') }}" class="group relative inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-900 bg-white rounded-2xl hover:bg-gray-50 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <span class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></span>
                    <span class="relative">Mulai Perjalanan Belajar</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white border-2 border-white/30 rounded-2xl hover:bg-white/10 hover:border-white transition-all duration-300 hover:scale-105 backdrop-blur-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login Sekarang
                </a>
                @else
                @if(Auth::user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" class="group relative inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-900 bg-white rounded-2xl hover:bg-gray-50 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <span class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-2xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></span>
                    <span class="relative">Dashboard Siswa</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
                @elseif(Auth::user()->role === 'mentor')
                <a href="{{ route('mentor.dashboard') }}" class="group relative inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-900 bg-white rounded-2xl hover:bg-gray-50 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <span class="absolute inset-0 bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></span>
                    <span class="relative">Dashboard Mentor</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
                @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="group relative inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-900 bg-white rounded-2xl hover:bg-gray-50 transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <span class="absolute inset-0 bg-gradient-to-r from-red-400 to-pink-500 rounded-2xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></span>
                    <span class="relative">Dashboard Admin</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
                @endif
                @endguest
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2">10K+</div>
                    <div class="text-white/70 text-sm uppercase tracking-wider">Alumni Sukses</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2">500+</div>
                    <div class="text-white/70 text-sm uppercase tracking-wider">Kursus Premium</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2">100+</div>
                    <div class="text-white/70 text-sm uppercase tracking-wider">Mentor Expert</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2">98%</div>
                    <div class="text-white/70 text-sm uppercase tracking-wider">Job Placement</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section with Modern Cards -->
<div class="py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 mb-6">
                <i class="fas fa-rocket mr-2"></i>
                Tentang eCourse69
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Platform Pembelajaran
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    Masa Depan
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                eCourse69 menghadirkan revolusi dalam pendidikan online dengan teknologi AI, mentor berkelas dunia, dan kurikulum yang selalu update mengikuti perkembangan industri terkini
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-center mb-20">
            <div class="space-y-8">
                <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 hover:shadow-3xl transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-brain text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">AI-Powered Learning</h3>
                            <p class="text-gray-600 leading-relaxed">Sistem pembelajaran adaptif yang menyesuaikan dengan gaya belajar dan kemampuan individu setiap siswa</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 hover:shadow-3xl transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-infinity text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Akses Lifetime</h3>
                            <p class="text-gray-600 leading-relaxed">Investasi sekali untuk akses seumur hidup dengan update konten berkala dan fitur-fitur terbaru</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-100 hover:shadow-3xl transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-handshake text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Job Guarantee</h3>
                            <p class="text-gray-600 leading-relaxed">Program job guarantee dengan tingkat penempatan kerja 98% dalam 6 bulan setelah lulus</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modern Stats Card -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-10 shadow-2xl border border-gray-100">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Pencapaian Kami</h3>
                    <p class="text-gray-600">Data real-time dari platform eCourse69</p>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div class="text-center group">
                        <div class="relative">
                            <div class="text-4xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">15K+</div>
                            <div class="absolute -inset-2 bg-blue-100 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                        </div>
                        <div class="text-gray-600 font-medium">Siswa Aktif</div>
                    </div>
                    <div class="text-center group">
                        <div class="relative">
                            <div class="text-4xl font-black bg-gradient-to-r from-green-600 to-teal-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">150+</div>
                            <div class="absolute -inset-2 bg-green-100 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                        </div>
                        <div class="text-gray-600 font-medium">Mentor Ahli</div>
                    </div>
                    <div class="text-center group">
                        <div class="relative">
                            <div class="text-4xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">500+</div>
                            <div class="absolute -inset-2 bg-purple-100 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                        </div>
                        <div class="text-gray-600 font-medium">Kursus Premium</div>
                    </div>
                    <div class="text-center group">
                        <div class="relative">
                            <div class="text-4xl font-black bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform duration-300">98%</div>
                            <div class="absolute -inset-2 bg-orange-100 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10"></div>
                        </div>
                        <div class="text-gray-600 font-medium">Success Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Course Categories with Floating Cards -->
<div class="py-24 bg-gradient-to-br from-gray-50 to-blue-50 relative">
    <div class="absolute inset-0 bg-grid-gray-100/50 bg-[size:40px_40px]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 mb-6">
                <i class="fas fa-layer-group mr-2"></i>
                Bidang Pembelajaran
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Pilih Passion
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Anda
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Dari teknologi hingga seni, dari bisnis hingga lifestyle - temukan kursus yang sesuai dengan minat dan tujuan karier Anda
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Programming Card -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-code text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Programming</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Web Development, Mobile App, AI & Machine Learning, DevOps</p>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 font-bold">35+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.9</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Design Card -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-green-600 to-teal-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-palette text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Design</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">UI/UX Design, Graphic Design, Motion Graphics, Branding</p>
                    <div class="flex justify-between items-center">
                        <span class="text-green-600 font-bold">40+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.8</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Digital Marketing Card -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Digital Marketing</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">SEO, Social Media, Content Marketing, Ads Management</p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-600 font-bold">28+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.9</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Card -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 to-red-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-briefcase text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Business</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Entrepreneurship, Finance, Leadership, Project Management</p>
                    <div class="flex justify-between items-center">
                        <span class="text-orange-600 font-bold">25+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.8</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Categories -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-pink-600 to-rose-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-pink-500 to-rose-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-camera text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Photography</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Portrait, Landscape, Commercial, Wedding Photography</p>
                    <div class="flex justify-between items-center">
                        <span class="text-pink-600 font-bold">22+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.9</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-language text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Languages</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">English, Mandarin, Japanese, Korean, Spanish</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-bold">18+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.7</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-teal-600 to-cyan-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-teal-500 to-cyan-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-music text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Music</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Guitar, Piano, Vocal, Music Production, Composition</p>
                    <div class="flex justify-between items-center">
                        <span class="text-teal-600 font-bold">30+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.8</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 to-green-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="bg-gradient-to-r from-emerald-500 to-green-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-dumbbell text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Health & Fitness</h3>
                    <p class="text-gray-600 text-sm mb-6 leading-relaxed">Yoga, Pilates, Nutrition, Personal Training</p>
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-600 font-bold">20+ Kursus</span>
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm ml-1">4.9</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us - Modern Features -->
<div class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 mb-6">
                <i class="fas fa-crown mr-2"></i>
                Keunggulan Premium
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Mengapa
                <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    eCourse69?
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pengalaman pembelajaran yang tak terlupakan dengan teknologi terdepan dan metodologi yang terbukti efektif
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-graduation-cap text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Kurikulum Terupdate</h3>
                        <p class="text-gray-600 leading-relaxed">Materi pembelajaran yang selalu fresh dan relevan dengan kebutuhan industri masa kini, diupdate setiap bulan oleh tim expert kami</p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-green-600 via-teal-600 to-cyan-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-infinity text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Akses Seumur Hidup</h3>
                        <p class="text-gray-600 leading-relaxed">Investasi sekali untuk akses unlimited ke semua materi, termasuk update konten dan fitur-fitur baru yang akan datang</p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users-cog text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Mentoring Premium</h3>
                        <p class="text-gray-600 leading-relaxed">Bimbingan personal 1-on-1 dengan mentor berpengalaman untuk memastikan kesuksesan pembelajaran Anda</p>
                    </div>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-project-diagram text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Project Based</h3>
                        <p class="text-gray-600 leading-relaxed">Belajar melalui proyek nyata yang dapat langsung digunakan sebagai portofolio profesional untuk melamar kerja</p>
                    </div>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-teal-600 via-green-600 to-emerald-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-teal-500 to-green-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-mobile-alt text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Mobile First</h3>
                        <p class="text-gray-600 leading-relaxed">Platform yang dioptimalkan untuk semua perangkat, belajar kapan saja dan dimana saja dengan kualitas terbaik</p>
                    </div>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-yellow-600 via-orange-600 to-red-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500">
                    <div class="text-center">
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-hand-holding-usd text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-900">Harga Terjangkau</h3>
                        <p class="text-gray-600 leading-relaxed">Investasi pendidikan dengan ROI tinggi - harga terjangkau untuk kualitas pembelajaran kelas dunia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center mt-20">
            <div class="relative inline-block">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl blur opacity-50"></div>
                <a href="{{ route('register') }}" class="relative bg-gradient-to-r from-purple-600 to-pink-600 text-white px-12 py-5 text-xl font-bold rounded-2xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 inline-flex items-center space-x-3">
                    <span>Mulai Transformasi Anda</span>
                    <i class="fas fa-rocket"></i>
                </a>
            </div>
            <p class="text-gray-500 mt-4 text-sm">Gratis trial 14 hari • Tidak ada komitmen • Cancel kapan saja</p>
        </div>
    </div>
</div>

<!-- Premium Features Section -->
<div class="py-24 bg-gradient-to-br from-gray-900 to-black text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:50px_50px]"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Fitur
                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                    Premium
                </span>
            </h2>
            <p class="text-xl text-white/80 max-w-3xl mx-auto">
                Teknologi pembelajaran terdepan yang membedakan kami dari platform lainnya
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-video text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Video 4K Interactive</h3>
                <p class="text-white/70 leading-relaxed">Streaming video berkualitas 4K dengan fitur interactive timeline, quiz terintegrasi, dan progress tracking real-time</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Expert Mentors</h3>
                <p class="text-white/70 leading-relaxed">Mentor bersertifikat internasional dengan pengalaman industri minimum 10 tahun di bidangnya masing-masing</p>
            </div>

            <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-500 hover:-translate-y-2">
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Sertifikat Course69</h3>
                <p class="text-white/70 leading-relaxed">Sertifikat digital terverifikasi blockchain yang diakui oleh 500+ perusahaan multinasional di seluruh dunia</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Information Section -->
<div class="py-24 bg-gradient-to-br from-indigo-50 to-purple-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 mb-6">
                <i class="fas fa-headset mr-2"></i>
                Hubungi Kami
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Siap Membantu
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    24/7
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Tim support profesional kami siap membantu perjalanan pembelajaran Anda kapan saja
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- WhatsApp -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 text-center">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">WhatsApp</h3>
                    <p class="text-gray-600 text-sm mb-4">Chat langsung dengan admin</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="text-green-600 font-semibold hover:text-green-700 transition-colors">
                        +62 812-3456-7890
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 text-center">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">Email</h3>
                    <p class="text-gray-600 text-sm mb-4">Support & Partnership</p>
                    <a href="mailto:support@ecourse69.com" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                        support@ecourse69.com
                    </a>
                </div>
            </div>

            <!-- Telegram -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 text-center">
                    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fab fa-telegram text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">Telegram</h3>
                    <p class="text-gray-600 text-sm mb-4">Community & Updates</p>
                    <a href="https://t.me/ecourse69_official" target="_blank" class="text-cyan-600 font-semibold hover:text-cyan-700 transition-colors">
                        @ecourse69_official
                    </a>
                </div>
            </div>

            <!-- Instagram -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-pink-500 to-rose-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 text-center">
                    <div class="bg-gradient-to-r from-pink-500 to-rose-600 text-white w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fab fa-instagram text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-gray-900">Instagram</h3>
                    <p class="text-gray-600 text-sm mb-4">Tips & Inspirasi</p>
                    <a href="https://instagram.com/ecourse69.official" target="_blank" class="text-pink-600 font-semibold hover:text-pink-700 transition-colors">
                        @ecourse69.official
                    </a>
                </div>
            </div>
        </div>

        <!-- Office Location -->
        <div class="mt-20">
            <div class="bg-white rounded-3xl p-12 shadow-2xl border border-gray-100">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-6">Visit Our Office</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Alamat Kantor</h4>
                                    <p class="text-gray-600">Jl. Sudirman No. 123, Senayan<br>Jakarta Pusat 10270, Indonesia</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Jumat: 09:00 - 18:00 WIB<br>Sabtu: 09:00 - 15:00 WIB</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Telepon</h4>
                                    <p class="text-gray-600">(021) 5555-0123</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl p-8 text-center">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-building text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-4">Jakarta Headquarters</h4>
                        <p class="text-gray-600 mb-6">Kunjungi kantor pusat kami untuk konsultasi gratis dan demo langsung platform pembelajaran</p>
                        <button class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            Jadwalkan Kunjungan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-gray-100 to-blue-100 text-gray-800 mb-6">
                <i class="fas fa-question-circle mr-2"></i>
                FAQ
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Pertanyaan
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Umum
                </span>
            </h2>
        </div>

        <div class="space-y-6">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-8 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Apakah sertifikat eCourse69 diakui industri?</h3>
                <p class="text-gray-600">Ya, sertifikat kami telah diakui oleh 500+ perusahaan multinasional dan menggunakan teknologi blockchain untuk verifikasi autentisitas.</p>
            </div>

            <div class="bg-gradient-to-r from-gray-50 to-purple-50 rounded-2xl p-8 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Berapa lama waktu yang dibutuhkan untuk menyelesaikan kursus?</h3>
                <p class="text-gray-600">Waktu penyelesaian bervariasi tergantung kursus dan kecepatan belajar. Rata-rata 2-6 bulan dengan komitmen 10-15 jam per minggu.</p>
            </div>

            <div class="bg-gradient-to-r from-gray-50 to-green-50 rounded-2xl p-8 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-3">Apakah ada job guarantee setelah lulus?</h3>
                <p class="text-gray-600">Ya, kami menjamin penempatan kerja untuk lulusan yang menyelesaikan program dengan nilai minimal 85% dalam waktu 6 bulan.</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .bg-grid-white\/\[0\.05\] {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(255 255 255 / 0.05)'%3e%3cpath d='m0 .5h32m-32 32v-32'/%3e%3c/svg%3e");
    }

    .bg-grid-gray-100\/50 {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(156 163 175 / 0.5)'%3e%3cpath d='m0 .5h32m-32 32v-32'/%3e%3c/svg%3e");
    }
</style>
@endsection