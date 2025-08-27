@extends('layouts.app')

@section('title', $course->title . ' - Siswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Course Header -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="h-64 bg-gradient-to-r from-primary to-secondary rounded-t-lg flex items-center justify-center">
            @if($course->thumbnail_url)
                <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" class="w-full h-full object-cover rounded-t-lg">
            @else
                <i class="fas fa-play-circle text-8xl text-white opacity-80"></i>
            @endif
        </div>
        
        <div class="p-8">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
                    <div class="flex items-center text-gray-600">
                        <i class="fas fa-user mr-2"></i>
                        <span>Mentor: {{ $course->mentor->user->name }}</span>
                    </div>
                </div>
            </div>
            
            <p class="text-gray-700 mb-6">{{ $course->description }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Course Content -->
        <div class="lg:col-span-2">
            <!-- Videos Section -->
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-play mr-2 text-primary"></i>
                        Materi Video
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
                            </div>
                        </div>
                        <a href="{{ route('student.courses.video', [$course, $video]) }}" 
                           class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary transition duration-300">
                            <i class="fas fa-play mr-1"></i>Tonton
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fas fa-video text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Belum ada video tersedia</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Chat Section -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">
                        <i class="fas fa-comments mr-2 text-primary"></i>
                        Diskusi Kursus
                    </h2>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('chats.course.show', $course) }}" 
                       class="block w-full bg-primary text-white text-center py-3 rounded-lg hover:bg-secondary transition duration-300">
                        <i class="fas fa-comment-dots mr-2"></i>
                        Bergabung dalam Diskusi
                    </a>
                    
                    <!-- Added mentor chat button -->
                    <a href="{{ route('chats.mentor_chats.show', $course->mentor->user) }}" 
                       class="block w-full bg-green-600 text-white text-center py-3 rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-user-tie mr-2"></i>
                        Chat dengan Mentor
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Assignment Section -->
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-tasks mr-2 text-primary"></i>
                        Tugas Akhir
                    </h3>
                </div>
                <div class="p-6">
                    @if($userAssignment)
                        <div class="mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                @if($userAssignment->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                        <i class="fas fa-clock mr-1"></i>Menunggu Review
                                    </span>
                                @elseif($userAssignment->status === 'accepted')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                        <i class="fas fa-check mr-1"></i>Diterima
                                    </span>
                                @elseif($userAssignment->status === 'rejected')
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                        <i class="fas fa-times mr-1"></i>Perlu Perbaikan
                                    </span>
                                @endif
                            </div>
                            
                            @if($userAssignment->mentor_feedback)
                                <div class="bg-gray-50 p-3 rounded-lg mb-4">
                                    <p class="text-sm font-medium text-gray-700 mb-1">Feedback Mentor:</p>
                                    <p class="text-sm text-gray-600">{{ $userAssignment->mentor_feedback }}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <form method="POST" action="{{ route('student.courses.submitAssignment', $course) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="assignment_file" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $userAssignment ? 'Upload Ulang Tugas' : 'Upload Tugas Akhir' }}
                            </label>
                            <input type="file" name="assignment_file" id="assignment_file" required
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-secondary">
                            <p class="text-xs text-gray-500 mt-1">Max: 10MB</p>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded hover:bg-secondary transition duration-300">
                            <i class="fas fa-upload mr-2"></i>
                            {{ $userAssignment ? 'Upload Ulang' : 'Submit Tugas' }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Course Info -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-info-circle mr-2 text-primary"></i>
                        Informasi Kursus
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-video text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">{{ $course->videos->count() }} Video</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">Mentor: {{ $course->mentor->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">Dibuat: {{ $course->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
