@extends('layouts.app')

@section('title', $video->title . ' - ' . $course->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li><a href="{{ route('student.courses.show', $course) }}" class="hover:text-primary">{{ $course->title }}</a></li>
            <li><i class="fas fa-chevron-right"></i></li>
            <li class="text-gray-900">{{ $video->title }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Video Player -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="aspect-video bg-black flex items-center justify-center">
                    @if($video->cloudinary_url)
                        <video controls class="w-full h-full">
                            <source src="{{ Storage::url($video->cloudinary_url) }}" type="video/mp4">
                            Browser Anda tidak mendukung video HTML5.
                        </video>
                    @else
                        <div class="text-white text-center">
                            <i class="fas fa-video text-6xl mb-4 opacity-50"></i>
                            <p>Video tidak tersedia</p>
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">{{ $video->title }}</h1>
                    @if($video->description)
                        <div class="prose max-w-none">
                            <p class="text-gray-700">{{ $video->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Course Videos List -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-900">Daftar Video</h3>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @foreach($course->videos as $index => $courseVideo)
                    <a href="{{ route('student.courses.video', [$course, $courseVideo]) }}" 
                       class="block p-4 border-b border-gray-100 hover:bg-gray-50 {{ $courseVideo->id === $video->id ? 'bg-primary bg-opacity-10 border-primary' : '' }}">
                        <div class="flex items-start">
                            <div class="h-8 w-8 rounded bg-primary text-white flex items-center justify-center text-sm font-medium mr-3 mt-1">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $courseVideo->title }}</p>
                                @if($courseVideo->description)
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit($courseVideo->description, 60) }}</p>
                                @endif
                            </div>
                            @if($courseVideo->id === $video->id)
                                <i class="fas fa-play text-primary text-sm mt-1"></i>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div class="mt-6 space-y-3">
                <a href="{{ route('student.courses.show', $course) }}" 
                   class="block w-full bg-gray-600 text-white text-center py-2 px-4 rounded hover:bg-gray-700 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Kursus
                </a>
                
                <a href="{{ route('chats.course.show', $course) }}" 
                   class="block w-full bg-primary text-white text-center py-2 px-4 rounded hover:bg-secondary transition duration-300">
                    <i class="fas fa-comments mr-2"></i>Diskusi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
