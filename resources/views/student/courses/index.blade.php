@extends('layouts.app')

@section('title', 'Daftar Kursus - Siswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Kursus</h1>
        <p class="text-gray-600">Pilih kursus yang ingin Anda ikuti</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="h-48 bg-gradient-to-r from-primary to-secondary flex items-center justify-center">
                @if($course->thumbnail_url)
                    <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                @else
                    <i class="fas fa-play-circle text-6xl text-white opacity-80"></i>
                @endif
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->title }}</h3>
                <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($course->description, 100) }}</p>
                
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="ml-2 text-sm text-gray-600">{{ $course->mentor->user->name }}</span>
                </div>

                <div class="flex justify-between items-center">
                    @if(in_array($course->id, $userCourseAccesses))
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-check mr-1"></i>Terdaftar
                        </span>
                        <a href="{{ route('student.courses.show', $course) }}" 
                           class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">
                            <i class="fas fa-arrow-right mr-1"></i>Masuk
                        </a>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                            <i class="fas fa-lock mr-1"></i>Terkunci
                        </span>
                        <a href="{{ route('student.courses.show', $course) }}" 
                           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">
                            <i class="fas fa-info mr-1"></i>Detail
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum Ada Kursus</h3>
            <p class="text-gray-600">Kursus akan segera tersedia</p>
        </div>
        @endforelse
    </div>

    @if($courses->hasPages())
    <div class="mt-8">
        {{ $courses->links() }}
    </div>
    @endif
</div>
@endsection
