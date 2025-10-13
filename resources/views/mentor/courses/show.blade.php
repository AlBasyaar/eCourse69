@extends('layouts.app')

@section('title', $course->title . ' - Mentor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Course Header -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="h-48 sm:h-64 bg-gradient-to-r from-primary to-secondary rounded-t-lg flex items-center justify-center overflow-hidden">
            @if($course->thumbnail)
                <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="w-full h-full object-cover rounded-t-lg">
            @else
                <i class="fas fa-play-circle text-6xl sm:text-8xl text-white opacity-80"></i>
            @endif
        </div>
        
        <div class="p-4 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 sm:gap-0 mb-4">
                <div class="w-full sm:w-auto">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
                    <p class="text-gray-600">{{ $course->courseAccesses->where('is_active', true)->count() }} siswa terdaftar</p>
                </div>
                <a href="{{ route('mentor.videos.create', $course) }}" class="w-full sm:w-auto bg-blue-600 text-white px-4 sm:px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>Tambah Video
                </a>
            </div>
            
            <p class="text-gray-700 mb-6 text-sm sm:text-base">{{ $course->description }}</p>
        </div>
    </div>

    <!-- Videos Section -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-4 sm:p-6 border-b border-gray-200">
            <h2 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center">
                <i class="fas fa-video mr-2 text-primary"></i>
                Video Pembelajaran
            </h2>
        </div>
        <div class="p-4 sm:p-6">
            @forelse($course->videos as $index => $video)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 border border-gray-200 rounded-lg mb-4 last:mb-0 gap-4 sm:gap-0">
                <div class="flex items-center w-full sm:w-auto">
                    <div class="h-12 w-12 rounded-lg bg-primary text-white flex items-center justify-center flex-shrink-0">
                        <span class="font-semibold">{{ $index + 1 }}</span>
                    </div>
                    <div class="ml-4 min-w-0">
                        <h3 class="font-medium text-gray-900 text-sm sm:text-base truncate">{{ $video->title }}</h3>
                        @if($video->description)
                            <p class="text-sm text-gray-500 hidden sm:block">{{ Str::limit($video->description, 80) }}</p>
                            <p class="text-sm text-gray-500 sm:hidden">{{ Str::limit($video->description, 50) }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">{{ $video->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex space-x-2 justify-end sm:justify-start w-full sm:w-auto">
                    <a href="{{ route('mentor.videos.edit', $video) }}" 
                       class="text-indigo-600 hover:text-indigo-900 px-3 py-1 rounded flex items-center">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('mentor.videos.delete', $video) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 rounded flex items-center">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-video text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 mb-4 text-sm sm:text-base">Belum ada video pembelajaran</p>
                <a href="{{ route('mentor.videos.create', $course) }}" class="w-full sm:w-auto bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center justify-center mx-auto sm:mx-0">
                    <i class="fas fa-plus mr-2"></i>Tambah Video Pertama
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection