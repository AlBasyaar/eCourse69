@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-700 bg-clip-text text-transparent mb-4">
            Dashboard Admin
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
            Kelola sistem kursus online dengan mudah dan efisien
        </p>
        <div class="mt-6 w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
        <!-- Total Siswa -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/20 to-indigo-500/20 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Total Siswa</p>
                        <p class="text-3xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors duration-300">{{ $totalStudents }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-trending-up text-green-500 mr-2"></i>
                    <span>Aktif dan terdaftar</span>
                </div>
            </div>
        </div>

        <!-- Total Mentor -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-100 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-400/20 to-emerald-500/20 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chalkboard-teacher text-2xl text-white"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-green-600 uppercase tracking-wide">Total Mentor</p>
                        <p class="text-3xl font-bold text-gray-900 group-hover:text-green-700 transition-colors duration-300">{{ $totalMentors }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-user-check text-green-500 mr-2"></i>
                    <span>Mentor profesional</span>
                </div>
            </div>
        </div>

        <!-- Total Kursus -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-violet-100 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-400/20 to-violet-500/20 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book text-2xl text-white"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-purple-600 uppercase tracking-wide">Total Kursus</p>
                        <p class="text-3xl font-bold text-gray-900 group-hover:text-purple-700 transition-colors duration-300">{{ $totalCourses }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-graduation-cap text-purple-500 mr-2"></i>
                    <span>Kursus tersedia</span>
                </div>
            </div>
        </div>

        <!-- Akses Aktif -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-amber-100 opacity-50 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-400/20 to-amber-500/20 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-key text-2xl text-white"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-orange-600 uppercase tracking-wide">Akses Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 group-hover:text-orange-700 transition-colors duration-300">{{ $activeCourseAccesses }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-unlock text-orange-500 mr-2"></i>
                    <span>Siswa dengan akses</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Aksi Cepat</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full mb-8"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kelola Mentor -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-1">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 opacity-0 group-hover:opacity-50 transition-opacity duration-500"></div>
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
            <div class="relative p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center p-4 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chalkboard-teacher text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kelola Mentor</h3>
                    <p class="text-gray-600 leading-relaxed">Tambah, edit, atau hapus mentor untuk memberikan pengalaman belajar terbaik</p>
                </div>
                
                <div class="space-y-4">
                    <a href="{{ route('admin.mentors.index') }}" class="group/btn flex items-center justify-center w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 px-6 rounded-2xl hover:from-blue-600 hover:to-blue-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        <i class="fas fa-list mr-3 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Lihat Semua Mentor
                    </a>
                    <a href="{{ route('admin.mentors.create') }}" class="group/btn flex items-center justify-center w-full bg-white border-2 border-blue-200 text-blue-600 py-4 px-6 rounded-2xl hover:bg-blue-50 hover:border-blue-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        <i class="fas fa-plus mr-3 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Tambah Mentor Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Kelola Kursus -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-1">
            <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-emerald-50 opacity-0 group-hover:opacity-50 transition-opacity duration-500"></div>
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-600"></div>
            <div class="relative p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center p-4 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 shadow-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kelola Kursus</h3>
                    <p class="text-gray-600 leading-relaxed">Tambah, edit, atau hapus kursus untuk memperluas katalog pembelajaran</p>
                </div>
                
                <div class="space-y-4">
                    <a href="{{ route('admin.courses.index') }}" class="group/btn flex items-center justify-center w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-4 px-6 rounded-2xl hover:from-green-600 hover:to-green-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        <i class="fas fa-list mr-3 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Lihat Semua Kursus
                    </a>
                    <a href="{{ route('admin.courses.create') }}" class="group/btn flex items-center justify-center w-full bg-white border-2 border-green-200 text-green-600 py-4 px-6 rounded-2xl hover:bg-green-50 hover:border-green-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        <i class="fas fa-plus mr-3 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Tambah Kursus Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Akses Kursus -->
        <div class="group relative overflow-hidden bg-white rounded-3xl shadow-soft hover:shadow-large transition-all duration-500 hover:-translate-y-1">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-violet-50 opacity-0 group-hover:opacity-50 transition-opacity duration-500"></div>
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-violet-600"></div>
            <div class="relative p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center p-4 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-key text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Akses Kursus</h3>
                    <p class="text-gray-600 leading-relaxed">Kelola akses siswa ke kursus untuk mengontrol pembelajaran</p>
                </div>
                
                <div class="space-y-4">
                    <a href="{{ route('admin.course_accesses.index') }}" class="group/btn flex items-center justify-center w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white py-4 px-6 rounded-2xl hover:from-purple-600 hover:to-purple-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        <i class="fas fa-list mr-3 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Kelola Semua Akses
                    </a>
                    <a href="{{ route('admin.course_accesses.create') }}" class="group/btn flex items-center justify-center w-full bg-white border-2 border-purple-200 text-purple-600 py-4 px-6 rounded-2xl hover:bg-purple-50 hover:border-purple-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        <i class="fas fa-plus mr-3 group-hover/btn:scale-110 transition-transform duration-200"></i>
                        Berikan Akses Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection