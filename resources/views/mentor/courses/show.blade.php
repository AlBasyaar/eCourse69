@extends('layouts.app')

@section('title', $course->title . ' - Mentor')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Course Header -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="h-64 bg-gradient-to-r from-primary to-secondary rounded-t-lg flex items-center justify-center">
            @if($course->thumbnail)
                <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="w-full h-full object-cover rounded-t-lg">
            @else
                <i class="fas fa-play-circle text-8xl text-white opacity-80"></i>
            @endif
        </div>
        
        <div class="p-8">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
                    <p class="text-gray-600">{{ $course->courseAccesses->where('is_active', true)->count() }} siswa terdaftar</p>
                </div>
                <a href="{{ route('mentor.videos.create', $course) }}" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Tambah Video
                </a>
            </div>
            
            <p class="text-gray-700 mb-6">{{ $course->description }}</p>
        </div>
    </div>

    <!-- Videos Section -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">
                <i class="fas fa-video mr-2 text-primary"></i>
                Video Pembelajaran
            </h2>
        </div>
        <div class="p-6">
            @forelse($course->videos as $index => $video)
            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg mb-4 last:mb-0">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-lg bg-primary text-white flex items-center justify-center">
                        <span class="font-semibold">{{ $index + 1 }}</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-900">{{ $video->title }}</h3>
                        @if($video->description)
                            <p class="text-sm text-gray-500">{{ Str::limit($video->description, 80) }}</p>
                        @endif
                        <p class="text-xs text-gray-400">Dibuat: {{ $video->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('mentor.videos.edit', $video) }}" 
                       class="text-indigo-600 hover:text-indigo-900 px-3 py-1 rounded">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('mentor.videos.delete', $video) }}" method="POST" class="inline" 
                          onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 rounded">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-video text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 mb-4">Belum ada video pembelajaran</p>
                <a href="{{ route('mentor.videos.create', $course) }}" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition duration-300">
                    <i class="fas fa-plus mr-2"></i>Tambah Video Pertama
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
