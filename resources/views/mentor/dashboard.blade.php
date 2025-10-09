@extends('layouts.app')

@section('title', 'Dashboard Mentor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Mentor</h1>
        <p class="text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Kursus Saya</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $courses->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Tugas Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingAssignments }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full  bg-green-100  text-green-600">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Tugas</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalAssignments }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- My Courses -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-book mr-2 text-primary"></i>
                    Kursus Saya
                </h3>
            </div>
            <div class="p-6">
                @forelse($courses as $course)
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg mb-4 last:mb-0">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-lg bg-primary text-white flex items-center justify-center">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-900">{{ $course->title }}</h4>
                            <p class="text-sm text-gray-500">{{ $course->videos->count() }} Video</p>
                        </div>
                    </div>
                    <a href="{{ route('mentor.courses.show', $course) }}" 
                       class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">
                        <i class="fas fa-cog mr-1"></i>Kelola
                    </a>
                </div>
                @empty
                <div class="text-center py-8">
                    <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Anda belum memiliki kursus</p>
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
                <a href="{{ route('mentor.courses.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="h-10 w-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Kelola Kursus</h4>
                        <p class="text-sm text-gray-500">Tambah video dan kelola konten</p>
                    </div>
                </a>

                <a href="{{ route('mentor.assignments.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="h-10 w-10 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Review Tugas</h4>
                        <p class="text-sm text-gray-500">Periksa tugas akhir siswa</p>
                    </div>
                </a>

                <a href="{{ route('chats.mentor_chats.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-700 transition duration-300">
                    <div class="h-10 w-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Chat dengan Siswa</h4>
                        <p class="text-sm text-gray-500">Komunikasi dengan siswa</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
