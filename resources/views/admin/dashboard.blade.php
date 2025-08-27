@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600">Kelola sistem kursus online</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Siswa</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Mentor</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalMentors }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Kursus</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalCourses }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-key text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Akses Aktif</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activeCourseAccesses }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-chalkboard-teacher mr-2 text-primary"></i>
                Kelola Mentor
            </h3>
            <p class="text-gray-600 mb-4">Tambah, edit, atau hapus mentor</p>
            <div class="space-y-2">
                <a href="{{ route('admin.mentors.index') }}" class="block w-full bg-primary text-white text-center py-2 px-4 rounded hover:bg-secondary transition duration-300">
                    <i class="fas fa-list mr-2"></i>Lihat Semua Mentor
                </a>
                <a href="{{ route('admin.mentors.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Tambah Mentor
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-book mr-2 text-primary"></i>
                Kelola Kursus
            </h3>
            <p class="text-gray-600 mb-4">Tambah, edit, atau hapus kursus</p>
            <div class="space-y-2">
                <a href="{{ route('admin.courses.index') }}" class="block w-full bg-primary text-white text-center py-2 px-4 rounded hover:bg-secondary transition duration-300">
                    <i class="fas fa-list mr-2"></i>Lihat Semua Kursus
                </a>
                <a href="{{ route('admin.courses.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Tambah Kursus
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-key mr-2 text-primary"></i>
                Akses Kursus
            </h3>
            <p class="text-gray-600 mb-4">Kelola akses siswa ke kursus</p>
            <div class="space-y-2">
                <a href="{{ route('admin.course_accesses.index') }}" class="block w-full bg-primary text-white text-center py-2 px-4 rounded hover:bg-secondary transition duration-300">
                    <i class="fas fa-list mr-2"></i>Kelola Akses
                </a>
                <a href="{{ route('admin.course_accesses.create') }}" class="block w-full bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Berikan Akses
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
