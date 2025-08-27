@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Siswa</h1>
        <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Kursus Aktif</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $enrolledCourses->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Tugas Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingAssignments }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-certificate text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sertifikat</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $completedCourses }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Enrolled Courses -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-book-open mr-2 text-primary"></i>
                    Kursus Saya
                </h3>
            </div>
            <div class="p-6">
                @forelse($enrolledCourses as $courseAccess)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg mb-4 last:mb-0">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-lg bg-primary text-white flex items-center justify-center">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">{{ $courseAccess->course->title }}</h4>
                            <p class="text-sm text-gray-500">Mentor: {{ $courseAccess->course->mentor->user->name }}</p>
                        </div>
                    </div>
                    <a href="{{ route('student.courses.show', $courseAccess->course) }}" 
                       class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">
                        <i class="fas fa-arrow-right mr-1"></i>Lanjut
                    </a>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 mb-4">Anda belum mengikuti kursus apapun</p>
                    <a href="{{ route('student.courses.index') }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">
                        <i class="fas fa-search mr-2"></i>Jelajahi Kursus
                    </a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-rocket mr-2 text-primary"></i>
                    Menu Cepat
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <a href="{{ route('student.courses.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-300">
                    <div class="h-10 w-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Jelajahi Kursus</h4>
                        <p class="text-sm text-gray-500">Temukan kursus baru yang menarik</p>
                    </div>
                </a>

                <a href="{{ route('student.certificates.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-300">
                    <div class="h-10 w-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Sertifikat Saya</h4>
                        <p class="text-sm text-gray-500">Lihat dan unduh sertifikat</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
