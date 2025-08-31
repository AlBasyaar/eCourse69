@extends('layouts.app')

@section('title', 'Welcome - Kursus Online')

@section('content')
<div class="bg-gradient-to-r from-primary to-secondary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Belajar Online dengan Mentor Terbaik
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Platform kursus online terpercaya dengan sertifikat resmi
            </p>
            <div class="space-x-4">
                @guest
                <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Mulai Belajar
                </a>
                <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition duration-300">
                    Login
                </a>
                @else
                @if(Auth::user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Dashboard Siswa
                </a>
                @elseif(Auth::user()->role === 'mentor')
                <a href="{{ route('mentor.dashboard') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Dashboard Mentor
                </a>
                @elseif(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Dashboard Admin
                </a>
                @endif
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- About eCourse69 Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tentang eCourse69</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                eCourse69 adalah platform pembelajaran online terdepan yang menghadirkan pengalaman belajar yang personal dan berkualitas tinggi
            </p>
        </div>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Misi Kami</h3>
                <p class="text-gray-600 mb-6">
                    Kami berkomitmen untuk memberikan akses pendidikan berkualitas kepada semua orang, di mana pun dan kapan pun.
                    Dengan teknologi modern dan mentor berpengalaman, kami memastikan setiap siswa mendapatkan pembelajaran yang efektif dan menyenangkan.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 mt-1">
                            <i class="fas fa-check text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Pembelajaran Interaktif</h4>
                            <p class="text-gray-600 text-sm">Metode pembelajaran yang engaging dan mudah dipahami</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 mt-1">
                            <i class="fas fa-check text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Fleksibilitas Waktu</h4>
                            <p class="text-gray-600 text-sm">Belajar sesuai dengan jadwal dan kecepatan Anda</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 mt-1">
                            <i class="fas fa-check text-sm"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Dukungan Penuh</h4>
                            <p class="text-gray-600 text-sm">Mentor siap membantu Anda sepanjang perjalanan belajar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="grid grid-cols-2 gap-6 text-center">
                    <div>
                        <div class="text-3xl font-bold text-primary">1000+</div>
                        <div class="text-gray-600">Siswa Aktif</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary">50+</div>
                        <div class="text-gray-600">Mentor Ahli</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary">200+</div>
                        <div class="text-gray-600">Kursus Tersedia</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-primary">95%</div>
                        <div class="text-gray-600">Tingkat Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bidang Kursus Section -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Bidang Kursus Kami</h2>
            <p class="text-lg text-gray-600">
                Pilih dari berbagai bidang pembelajaran yang dirancang sesuai dengan kebutuhan industri modern
            </p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-blue-100 text-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-code text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Programming</h3>
                <p class="text-gray-600 text-sm mb-4">Web Development, Mobile App, AI & Machine Learning</p>
                <div class="text-primary text-sm font-medium">25+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-green-100 text-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-palette text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Design</h3>
                <p class="text-gray-600 text-sm mb-4">UI/UX Design, Graphic Design, Video Editing</p>
                <div class="text-primary text-sm font-medium">30+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-purple-100 text-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Digital Marketing</h3>
                <p class="text-gray-600 text-sm mb-4">SEO, Social Media, Content Marketing</p>
                <div class="text-primary text-sm font-medium">20+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-yellow-100 text-yellow-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Business</h3>
                <p class="text-gray-600 text-sm mb-4">Entrepreneurship, Finance, Project Management</p>
                <div class="text-primary text-sm font-medium">15+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-red-100 text-red-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-camera text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Photography</h3>
                <p class="text-gray-600 text-sm mb-4">Portrait, Landscape, Commercial Photography</p>
                <div class="text-primary text-sm font-medium">18+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-indigo-100 text-indigo-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-language text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Bahasa</h3>
                <p class="text-gray-600 text-sm mb-4">English, Mandarin, Japanese, Korean</p>
                <div class="text-primary text-sm font-medium">12+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-pink-100 text-pink-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-music text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Musik</h3>
                <p class="text-gray-600 text-sm mb-4">Gitar, Piano, Vocal, Music Production</p>
                <div class="text-primary text-sm font-medium">22+ Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition duration-300">
                <div class="bg-teal-100 text-teal-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dumbbell text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2">Fitness</h3>
                <p class="text-gray-600 text-sm mb-4">Yoga, Pilates, Weight Training, Nutrition</p>
                <div class="text-primary text-sm font-medium">16+ Kursus</div>
            </div>
        </div>
    </div>
</div>

<!-- Kenapa Pilih Course Section -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Kenapa Pilih eCourse69?</h2>
            <p class="text-lg text-gray-600">
                Kami memberikan pengalaman pembelajaran terbaik dengan berbagai keunggulan yang tidak akan Anda temukan di tempat lain
            </p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Kurikulum Terupdate</h3>
                <p class="text-gray-600">Materi pembelajaran selalu diperbarui sesuai dengan perkembangan industri dan teknologi terbaru</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-r from-green-500 to-teal-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Akses Seumur Hidup</h3>
                <p class="text-gray-600">Sekali daftar, Anda dapat mengakses materi kursus selamanya dengan update konten berkala</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users-cog text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Mentoring 1-on-1</h3>
                <p class="text-gray-600">Dapatkan bimbingan personal dari mentor berpengalaman untuk memaksimalkan pembelajaran Anda</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-project-diagram text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Project Based Learning</h3>
                <p class="text-gray-600">Belajar melalui proyek nyata yang dapat Anda gunakan untuk membangun portofolio profesional</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-r from-indigo-500 to-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-mobile-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Mobile Friendly</h3>
                <p class="text-gray-600">Platform yang responsif memungkinkan Anda belajar kapan saja dan di mana saja melalui perangkat apapun</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center hover:shadow-xl transition duration-300">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-hand-holding-usd text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Harga Terjangkau</h3>
                <p class="text-gray-600">Investasi pendidikan dengan harga yang sangat terjangkau dibandingkan kualitas yang Anda dapatkan</p>
            </div>
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('register') }}"
                class="bg-gradient-to-r from-primary to-secondary text-white 
               px-5 py-3 text-base
               sm:px-6 sm:py-3 sm:text-lg
               md:px-8 md:py-4 md:text-lg
               rounded-lg font-semibold
               transition duration-300 
               hover:shadow-lg md:hover:-translate-y-1
               inline-block">
                Mulai Perjalanan Belajar Anda Sekarang
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-video text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Video Berkualitas</h3>
            <p class="text-gray-600">Materi pembelajaran dalam bentuk video HD dengan penjelasan yang mudah dipahami</p>
        </div>
        <div class="text-center">
            <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Mentor Berpengalaman</h3>
            <p class="text-gray-600">Belajar langsung dari mentor yang berpengalaman di bidangnya</p>
        </div>
        <div class="text-center">
            <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-certificate text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Sertifikat Resmi</h3>
            <p class="text-gray-600">Dapatkan sertifikat resmi setelah menyelesaikan kursus</p>
        </div>
    </div>
</div>
@endsection