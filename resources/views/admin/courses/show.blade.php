@extends('layouts.app')

@section('title', $course->title . ' - Detail Kursus')

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
                    <div class="flex items-center text-gray-600 mb-2">
                        <i class="fas fa-user mr-2"></i>
                        <span>Mentor: {{ $course->mentor->user->name }}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-users mr-2"></i>
                        <span>{{ $course->courseAccesses->where('is_active', true)->count() }} siswa terdaftar</span>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.courses.edit', $course) }}" class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
            
            <p class="text-gray-700 mb-6">{{ $course->description }}</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-video text-primary mr-2"></i>
                        <span class="text-sm font-medium">{{ $course->videos->count() }} Video</span>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-money-bill text-primary mr-2"></i>
                        <span class="text-sm font-medium">Rp {{ number_format($course->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-primary mr-2"></i>
                        <span class="text-sm font-medium">{{ $course->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Videos -->
    <div class="bg-white rounded-lg shadow mb-8">
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
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-video text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada video pembelajaran</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Enrolled Students -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">
                <i class="fas fa-users mr-2 text-primary"></i>
                Siswa Terdaftar
            </h2>
        </div>
        <div class="p-6">
            @forelse($course->courseAccesses->where('is_active', true) as $access)
            <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg mb-4 last:mb-0">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-primary text-white flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">{{ $access->student->user->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $access->student->user->email }}</p>
                        <p class="text-xs text-gray-400">Bergabung: {{ $access->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada siswa yang terdaftar</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
