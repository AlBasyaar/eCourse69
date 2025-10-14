@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header with Action Button -->
        <div class="flex flex-col sm:flex-row items-center justify-between mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-800">Kelola Akses Kursus</h1>
                <p class="mt-2 text-lg text-gray-500">Lihat dan kelola akses siswa ke kursus.</p>
            </div>
            <a href="{{ route('admin.course_accesses.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full shadow-lg hover:from-blue-600 hover:to-indigo-700 transition-all transform hover:scale-105">
                <i class="fas fa-plus-circle mr-2"></i>
                Berikan Akses Baru
            </a>
        </div>

        <!-- Course Accesses Cards/Table -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($courseAccesses as $access)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 flex flex-col justify-between hover:shadow-xl transition-shadow">
                <div>
                    <!-- Student Info -->
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 h-12 w-12">
                            <!-- Placeholder for profile image -->
                            <div class="h-12 w-12 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 text-lg font-bold">
                                {{ strtoupper(substr($access->user->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-lg font-semibold text-gray-900">{{ $access->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $access->user->email }}</div>
                        </div>
                    </div>

                    <!-- Course Info -->
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="text-sm text-gray-600 font-medium">Kursus:</div>
                        <div class="text-md font-semibold text-gray-800">{{ $access->course->title }}</div>
                        <div class="text-sm text-gray-500">by {{ $access->course->mentor->user->name }}</div>
                    </div>
                </div>

                <!-- Status & Date -->
                <div class="flex items-center justify-between mt-6">
                    <div>
                        <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium 
                            @if($access->is_active) bg-green-200 text-green-800 @else bg-red-200 text-red-800 @endif">
                            @if($access->is_active)
                                <i class="fas fa-check-circle mr-1"></i>Aktif
                            @else
                                <i class="fas fa-times-circle mr-1"></i>Nonaktif
                            @endif
                        </span>
                    </div>
                    <div class="text-sm text-gray-500">
                        Sejak {{ $access->created_at->format('d M Y') }}
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-6 flex justify-end">
                    <form action="{{ route('admin.course_accesses.toggle', $access) }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full text-center px-4 py-2 rounded-full text-sm font-medium 
                            @if($access->is_active) bg-red-500 text-white hover:bg-red-600 @else bg-green-500 text-white hover:bg-green-600 @endif transition-colors">
                            @if($access->is_active)
                                <i class="fas fa-ban mr-1"></i>Nonaktifkan
                            @else
                                <i class="fas fa-check-circle mr-1"></i>Aktifkan
                            @endif
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 text-center text-gray-400">
                <i class="fas fa-users-slash text-6xl mb-4"></i>
                <p class="text-xl font-medium">Tidak ada akses kursus yang ditemukan.</p>
                <p class="text-sm mt-2">Mulai dengan memberikan akses kepada siswa untuk melihatnya di sini.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courseAccesses->hasPages())
        <div class="mt-10">
            {{ $courseAccesses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection