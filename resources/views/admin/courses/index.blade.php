@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    {{-- Page Header --}}
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Course Management</h1>
                    <p class="text-gray-600 mt-1">Create and manage learning courses</p>
                </div>
                {{-- Tombol ini sekarang melempar event 'open-create-modal' --}}
                <button x-data @click="$dispatch('open-create-modal')" class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-6 py-3 rounded-xl hover:from-primary-700 hover:to-secondary-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Create New Course
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Success & Error Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <span class="block sm:inline">Please fix the following errors:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-book text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Courses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $courses->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-play-circle text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Courses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $courses->where('is_active', true)->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Enrollments</p>
                        <p class="text-2xl font-bold text-gray-900">2,345</p> {{-- Ganti dengan data dinamis jika ada --}}
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-certificate text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Completed</p>
                        <p class="text-2xl font-bold text-gray-900">1,876</p> {{-- Ganti dengan data dinamis jika ada --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Courses List Container --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900">All Courses</h2>
                    {{-- Filter UI (opsional) --}}
                </div>
            </div>

            @if($courses->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="group bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                                <div class="aspect-video bg-gradient-to-br from-primary-400 to-secondary-400 relative overflow-hidden">
                                    @if($course->thumbnail_url)
                                        <img src="{{ asset('storage/' . $course->thumbnail_url) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-book text-white text-4xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6">
<div class="flex items-center space-x-1 flex-shrink-0 ml-2">
    {{-- Tombol Edit --}}
    <button
        x-data
        @click="$dispatch('open-edit-course', { 
            id: {{ $course->id }}, 
            title: '{{ str_replace("'", "\'", $course->title) }}', 
            description: '{{ str_replace("'", "\'", $course->description) }}', 
            mentorId: {{ $course->mentor_id }} 
        })"
        class="text-gray-400 hover:text-primary-600 transition-colors"
    >
        <i class="fas fa-edit"></i>
    </button>
    
    {{-- Tombol Delete --}}
    <button
        x-data
        @click="$dispatch('open-delete-course', { 
            id: {{ $course->id }}, 
            title: '{{ str_replace("'", "\'", $course->title) }}' 
        })"
        class="text-gray-400 hover:text-red-600 transition-colors"
    >
        <i class="fas fa-trash"></i>
    </button>
</div>

                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $course->description ?: 'No description provided for this course.' }}
                                    </p>

                                    <div class="flex items-center justify-between mt-4">
                                        <a href="#" class="flex-1 bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors text-sm font-medium text-center">
                                            <i class="fas fa-eye mr-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Courses Found</h3>
                    <p class="text-gray-500 mb-6">Create your first course to get started.</p>
                    <button x-data @click="$dispatch('open-create-modal')" class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Create First Course
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modals -->

    {{-- Create Course Modal --}}
    {{-- Modal ini mendengarkan event 'open-create-modal' dari window --}}
    <div x-data="{ open: false }" 
         x-on:open-create-modal.window="open = true" 
         x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
         style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-2xl bg-white" @click.away="open = false">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Create New Course</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('admin.courses.create') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    {{-- Form fields --}}
                    <input type="text" name="title" required placeholder="Course Title..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    <textarea name="description" rows="4" placeholder="Course Description..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"></textarea>
                    <select name="mentor_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">Select a mentor</option>
                        @foreach($mentors as $mentor)
                            <option value="{{ $mentor->id }}">{{ $mentor->user->name }}</option>
                        @endforeach
                    </select>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">

                    <div class="flex items-center justify-end space-x-4 pt-6">
                        <button type="button" @click="open = false" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Cancel</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary-600 to-secondary-600 text-white rounded-lg">Create Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Course Modal --}}
    {{-- Modal ini mendengarkan event 'open-edit-course' dan mengisi data dari event detail --}}
    <div x-data="{ open: false, courseId: '', title: '', description: '', mentorId: '' }" 
         x-on:open-edit-course.window="open = true; courseId = $event.detail.id; title = $event.detail.title; description = $event.detail.description; mentorId = $event.detail.mentorId;"
         x-show="open"
         x-transition
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
         style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-2xl bg-white" @click.away="open = false">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Update Course</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
                </div>
                
                <form :action="`/admin/courses/${courseId}`" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <input type="text" name="title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg" x-model="title">
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg" x-model="description"></textarea>
                    <select name="mentor_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg" x-model="mentorId">
                        <option value="">Select a mentor</option>
                        @foreach($mentors as $mentor)
                            <option value="{{ $mentor->id }}">{{ $mentor->user->name }}</option>
                        @endforeach
                    </select>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="text-xs text-gray-500 -mt-4">Leave blank to keep the current thumbnail.</p>

                    <div class="flex items-center justify-end space-x-4 pt-6">
                        <button type="button" @click="open = false" class="px-6 py-3 border border-gray-300 rounded-lg">Cancel</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-secondary-600 to-primary-600 text-white rounded-lg">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Course Modal --}}
    {{-- Modal ini mendengarkan event 'open-delete-course' --}}
    <div x-data="{ open: false, courseId: '', title: '' }" 
         x-on:open-delete-course.window="open = true; courseId = $event.detail.id; title = $event.detail.title;"
         x-show="open"
         x-transition
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" 
         style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-2xl bg-white" @click.away="open = false">
            <div class="mt-3 text-center">
                <i class="fas fa-exclamation-triangle text-red-500 text-4xl mx-auto mb-4"></i>
                <h3 class="text-xl leading-6 font-medium text-gray-900">Confirm Deletion</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete the course "<strong x-text="title"></strong>"? This action cannot be undone.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <form :action="`/admin/courses/${courseId}`" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Yes, Delete</button>
                    </form>
                    <button @click="open = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 ml-2">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
