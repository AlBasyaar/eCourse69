@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('siswa.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                        <p class="text-gray-600 mt-1">Instructor: {{ $course->mentor->user->name }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-check mr-2"></i>Enrolled
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Course Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Course Overview -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <div class="aspect-video bg-gradient-to-br from-primary-400 to-secondary-400 rounded-xl mb-6 relative overflow-hidden">
                        @if($course->thumbnail_url)
                            <img src="{{ asset('storage/' . $course->thumbnail_url) }}" 
                                 alt="{{ $course->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-play-circle text-white text-6xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                            <button class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all transform hover:scale-105">
                                <i class="fas fa-play text-primary-600 text-2xl ml-1"></i>
                            </button>
                        </div>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Course</h2>
                    <p class="text-gray-600 mb-6">
                        {{ $course->description ?: 'This comprehensive course will provide you with all the essential knowledge and practical skills needed to excel in modern development. Through hands-on projects and expert guidance, you\'ll build a strong foundation and advance your career.' }}
                    </p>

                    <!-- Course Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary-600">{{ rand(10, 50) }}</div>
                            <div class="text-sm text-gray-600">Lessons</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-secondary-600">{{ rand(20, 80) }}h</div>
                            <div class="text-sm text-gray-600">Duration</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">{{ rand(5, 15) }}</div>
                            <div class="text-sm text-gray-600">Projects</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">{{ number_format(rand(40, 50) / 10, 1) }}</div>
                            <div class="text-sm text-gray-600">Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Course Curriculum -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-list text-primary-600 mr-3"></i>Course Curriculum
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @for($i = 1; $i <= 8; $i++)
                                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-primary-300 hover:bg-primary-50 transition-all cursor-pointer">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900">Chapter {{ $i }}: 
                                                @switch($i)
                                                    @case(1)
                                                        Introduction and Setup
                                                        @break
                                                    @case(2)
                                                        Basic Concepts
                                                        @break
                                                    @case(3)
                                                        Advanced Techniques
                                                        @break
                                                    @case(4)
                                                        Practical Implementation
                                                        @break
                                                    @case(5)
                                                        Best Practices
                                                        @break
                                                    @case(6)
                                                        Real-world Applications
                                                        @break
                                                    @case(7)
                                                        Performance Optimization
                                                        @break
                                                    @default
                                                        Final Project & Review
                                                @endswitch
                                            </h3>
                                            <p class="text-sm text-gray-500">{{ rand(15, 45) }} minutes • {{ rand(3, 8) }} lessons</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($i <= 3)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                                                <i class="fas fa-check mr-1"></i>Completed
                                            </span>
                                        @elseif($i == 4)
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                                                <i class="fas fa-clock mr-1"></i>In Progress
                                            </span>
                                        @else
                                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">
                                                <i class="fas fa-lock mr-1"></i>Locked
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Final Assignment -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clipboard-check text-primary-600 mr-3"></i>Final Assignment
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($finalAssignment)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-medium text-blue-900">Assignment Status</h3>
                                        <p class="text-sm text-blue-700">Submitted {{ $finalAssignment->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if($finalAssignment->status == 'submitted')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-clock mr-1"></i>Under Review
                                        </span>
                                    @elseif($finalAssignment->status == 'approved')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-check mr-1"></i>Approved
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-redo mr-1"></i>Needs Revision
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($finalAssignment->mentor_feedback)
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4">
                                    <h4 class="font-medium text-gray-900 mb-2">Mentor Feedback</h4>
                                    <p class="text-gray-700 whitespace-pre-wrap">{{ $finalAssignment->mentor_feedback }}</p>
                                </div>
                            @endif

                            @if($finalAssignment->status == 'revisi')
                                <form method="POST" action="{{ route('siswa.assignments.submit', $course->id) }}" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="assignment_file" class="block text-sm font-medium text-gray-700 mb-2">
                                            Resubmit Assignment File
                                        </label>
                                        <input type="file" 
                                               name="assignment_file" 
                                               id="assignment_file" 
                                               accept=".zip,.rar,.pdf,.doc,.docx"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                               required>
                                        <p class="text-xs text-gray-500 mt-1">Accepted formats: ZIP, RAR, PDF, DOC, DOCX (Max: 10MB)</p>
                                    </div>
                                    <button type="submit" class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors">
                                        <i class="fas fa-upload mr-2"></i>Resubmit Assignment
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-upload text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Submit Your Final Assignment</h3>
                                    <p class="text-gray-500 mb-6">Upload your completed project file to get your certificate</p>
                                    
                                    <form method="POST" action="{{ route('siswa.assignments.submit', $course->id) }}" enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        <div>
                                            <input type="file" 
                                                   name="assignment_file" 
                                                   id="assignment_file" 
                                                   accept=".zip,.rar,.pdf,.doc,.docx"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                                   required>
                                            <p class="text-xs text-gray-500 mt-2">Accepted formats: ZIP, RAR, PDF, DOC, DOCX (Max: 10MB)</p>
                                        </div>
                                        <button type="submit" class="bg-gradient-to-r from-primary-600 to-secondary-600 text-white px-8 py-3 rounded-lg hover:from-primary-700 hover:to-secondary-700 transition-all duration-300 transform hover:scale-105">
                                            <i class="fas fa-upload mr-2"></i>Submit Assignment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Course Sidebar -->
            <div class="space-y-6">
                <!-- Progress Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-chart-pie text-primary-600 mr-3"></i>Your Progress
                    </h3>
                    <div class="relative mb-4">
                        <div class="w-24 h-24 mx-auto">
                            <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="transparent"
                                      d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                                <path class="text-primary-600" stroke="currentColor" stroke-width="3" fill="transparent" stroke-linecap="round"
                                      stroke-dasharray="{{ 45 }}, 100"
                                      d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-900">45%</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center text-sm text-gray-600">
                        3 of 8 chapters completed
                    </div>
                </div>

                <!-- Instructor Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-chalkboard-teacher text-primary-600 mr-3"></i>Your Instructor
                    </h3>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary-400 to-secondary-400 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                            {{ substr($course->mentor->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">{{ $course->mentor->user->name }}</h4>
                            <p class="text-sm text-gray-500">Senior Developer</p>
                            <p class="text-xs text-gray-400">5+ years experience</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="text-gray-600">Students: {{ rand(100, 500) }}</span>
                        <span class="text-gray-600">Courses: {{ rand(3, 10) }}</span>
                    </div>
                    <button class="w-full mt-4 bg-primary-100 text-primary-700 px-4 py-2 rounded-lg hover:bg-primary-200 transition-colors text-sm font-medium">
                        <i class="fas fa-comment mr-2"></i>Message Instructor
                    </button>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-bolt text-primary-600 mr-3"></i>Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors text-sm">
                            <i class="fas fa-bookmark mr-3 text-primary-600"></i>Bookmark This Course
                        </button>
                        <button class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors text-sm">
                            <i class="fas fa-share mr-3 text-secondary-600"></i>Share Course
                        </button>
                        <button class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors text-sm">
                            <i class="fas fa-download mr-3 text-purple-600"></i>Download Resources
                        </button>
                        <button class="w-full text-left px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors text-sm">
                            <i class="fas fa-certificate mr-3 text-green-600"></i>View Certificate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection