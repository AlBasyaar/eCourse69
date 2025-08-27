@extends('layouts.app')

@section('title', 'Kursus Saya - Mentor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Kursus Saya</h1>
        <p class="text-gray-600">Kelola kursus dan video pembelajaran</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="h-48 bg-gradient-to-r from-primary to-secondary flex items-center justify-center">
                @if($course->thumbnail)
                    <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-play-circle text-6xl text-white opacity-80"></i>
                @endif
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->title }}</h3>
                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($course->description, 100) }}</p>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-video mr-1"></i>{{ $course->videos->count() }} Video
                        </span>
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-users mr-1"></i>{{ $course->courseAccesses->where('is_active', true)->count() }} Siswa
                        </span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('mentor.courses.show', $course) }}" 
                       class="flex-1 bg-primary text-white text-center px-4 py-2 rounded hover:bg-secondary transition duration-300">
                        <i class="fas fa-cog mr-1"></i>Kelola
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum Ada Kursus</h3>
            <p class="text-gray-600">Anda belum memiliki kursus yang ditugaskan</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
