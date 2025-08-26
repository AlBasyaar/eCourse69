@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Student Dashboard</h1>
                    <p class="text-gray-600 mt-1">Continue your learning journey, {{ auth()->user()->name }}!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-graduation-cap mr-2"></i>Student
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Enrolled Courses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ collect($userAccesses)->where(true)->count() }}</p>
                        <p class="text-xs text-green-600"><i class="fas fa-play mr-1"></i>Active</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-secondary-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Hours Learned</p>
                        <p class="text-2xl font-bold text-gray-900">{{ rand(50, 200) }}h</p>
                        <p class="text-xs text-blue-600"><i class="fas fa-arrow-up mr-1"></i>This month</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tasks text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Assignments</p>
                        <p class="text-2xl font-bold text-gray-900">{{ rand(5, 15) }}</p>
                        <p class="text-xs text-orange-600"><i class="fas fa-clock mr-1"></i>{{ rand(1, 3) }} Pending</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-certificate text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Certificates</p>
                        <p class="text-2xl font-bold text-gray-900">{{ rand(1, 5) }}</p>
                        <p class="text-xs text-green-600"><i class="fas fa-medal mr-1"></i>Earned</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Courses -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 mb-8">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-book text-primary-600 mr-3"></i>My Courses
                    </h2>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">{{ $courses->count() }} courses available</span>
                    </div>
                </div>
            </div>

            @if($courses->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            @php
                                $hasAccess = isset($userAccesses[$course->id]) && $userAccesses[$course->id];
                            @endphp
                            
                            <div class="group {{ $hasAccess ? 'hover:shadow-lg' : 'opacity-75' }} bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300 {{ $hasAccess ? 'transform hover:-translate-y-1' : '' }}">
                                <!-- Course Thumbnail -->
                                <div class="aspect-video bg-gradient-to-br from-primary-400 to-secondary-400 relative overflow-hidden">
                                    @if($course->thumbnail_url)
                                        <img src="{{ asset('storage/' . $course->thumbnail_url) }}" 
                                             alt="{{ $course->title }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-book text-white text-4xl"></i>
                                        </div>
                                    @endif
                                    
                                    @if(!$hasAccess)
                                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                            <div class="bg-white bg-opacity-90 rounded-lg px-4 py-2">
                                                <i class="fas fa-lock text-gray-600 mr-2"></i>
                                                <span class="text-gray-600 font-medium">Access Required</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-10 transition-all duration-300"></div>
                                        <div class="absolute top-4 left-4">
                                            <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                                <i class="fas fa-check mr-1"></i>Enrolled
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <div class="bg-white bg-opacity-90 rounded-lg p-2">
                                            <div class="text-xs text-gray-600">Progress</div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                                <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $hasAccess ? rand(20, 80) : 0 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Course Content -->
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 {{ $hasAccess ? 'group-hover:text-primary-600' : '' }} transition-colors">
                                        {{ $course->title }}
                                    </h3>

                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $course->description ?: 'This comprehensive course will teach you everything you need to know about modern development practices and industry standards.' }}
                                    </p>

                                    <!-- Mentor Info -->
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-gradient-to-r from-primary-400 to-secondary-400 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{ substr($course->mentor->user->name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $course->mentor->user->name }}</p>
                                            <p class="text-xs text-gray-500">Instructor</p>
                                        </div>
                                    </div>

                                    <!-- Course Stats -->
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                        <span><i class="fas fa-video mr-1"></i>{{ rand(10, 50) }} Lessons</span>
                                        <span><i class="fas fa-clock mr-1"></i>{{ rand(20, 80) }}h</span>
                                        <span><i class="fas fa-star text-yellow-400 mr-1"></i>{{ number_format(rand(40, 50) / 10, 1) }}</span>
                                    </div>

                                    <!-- Action Button -->
                                    @if($hasAccess)
                                        <a href="{{ route('siswa.courses.show', $course->id) }}" 
                                           class="w-full bg-primary-600 text-white px-4 py-3 rounded-lg hover:bg-primary-700 transition-colors text-sm font-medium text-center block">
                                            <i class="fas fa-play mr-2"></i>Continue Learning
                                        </a>
                                    @else
                                        <div class="w-full bg-gray-100 text-gray-500 px-4 py-3 rounded-lg text-sm font-medium text-center cursor-not-allowed">
                                            <i class="fas fa-lock mr-2"></i>Contact Admin for Access
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-book text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Courses Available</h3>
                    <p class="text-gray-500 mb-6">Courses will appear here once they are created by admin.</p>
                </div>
            @endif
        </div>

        <!-- Learning Activity & Achievements -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-clock text-primary-600 mr-3"></i>Recent Activity
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Started lesson: <span class="font-medium">React Components Basics</span></p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Completed assignment: <span class="font-medium">JavaScript Functions</span></p>
                                <p class="text-xs text-gray-500">1 day ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-upload text-purple-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Submitted final project: <span class="font-medium">Portfolio Website</span></p>
                                <p class="text-xs text-gray-500">2 days ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-certificate text-orange-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Earned certificate: <span class="font-medium">Web Development Basics</span></p>
                                <p class="text-xs text-gray-500">1 week ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievements -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-trophy text-primary-600 mr-3"></i>Achievements
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg border border-yellow-200">
                            <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-900">First Course</p>
                            <p class="text-xs text-gray-500">Completed</p>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border border-green-200">
                            <div class="w-12 h-12 bg-green-400 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-fire text-white text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-900">7 Day Streak</p>
                            <p class="text-xs text-gray-500">Active</p>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-200">
                            <div class="w-12 h-12 bg-blue-400 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-900">Fast Learner</p>
                            <p class="text-xs text-gray-500">Earned</p>
                        </div>

                        <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg border border-purple-200 opacity-50">
                            <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-trophy text-white text-xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-500">Expert Level</p>
                            <p class="text-xs text-gray-400">Locked</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection