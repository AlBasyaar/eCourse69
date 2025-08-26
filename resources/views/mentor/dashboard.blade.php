@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mentor Dashboard</h1>
                    <p class="text-gray-600 mt-1">Welcome back, {{ auth()->user()->name }}!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-secondary-500 to-primary-500 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Mentor
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
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">My Students</p>
                        <p class="text-2xl font-bold text-gray-900">{{ rand(20, 100) }}</p>
                        <p class="text-xs text-green-600"><i class="fas fa-arrow-up mr-1"></i>5% this month</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-secondary-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tasks text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Pending Assignments</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $assignments->where('status', 'submitted')->count() }}</p>
                        <p class="text-xs text-orange-600"><i class="fas fa-clock mr-1"></i>Need Review</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">My Courses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ rand(3, 8) }}</p>
                        <p class="text-xs text-blue-600"><i class="fas fa-plus mr-1"></i>Active</p>
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
                        <p class="text-sm font-medium text-gray-600">Certificates Issued</p>
                        <p class="text-2xl font-bold text-gray-900">{{ rand(50, 200) }}</p>
                        <p class="text-xs text-green-600"><i class="fas fa-medal mr-1"></i>This month</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Assignments Section -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clipboard-list text-primary-600 mr-3"></i>Assignment Reviews
                        </h2>
                        <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $assignments->where('status', 'submitted')->count() }} Pending
                        </span>
                    </div>
                </div>
                
                @if($assignments->count() > 0)
                    <div class="divide-y divide-gray-200">
                        @foreach($assignments->take(5) as $assignment)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-primary-400 to-secondary-400 rounded-full flex items-center justify-center text-white font-semibold">
                                            {{ substr($assignment->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-900">{{ $assignment->user->name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $assignment->course->title }}</p>
                                            <p class="text-xs text-gray-400">Submitted {{ $assignment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        @if($assignment->status == 'submitted')
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                                <i class="fas fa-clock mr-1"></i>Pending Review
                                            </span>
                                        @elseif($assignment->status == 'approved')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                                <i class="fas fa-check mr-1"></i>Approved
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                                <i class="fas fa-redo mr-1"></i>Needs Revision
                                            </span>
                                        @endif
                                        <a href="{{ route('mentor.assignments.show', $assignment->id) }}" 
                                           class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors text-sm">
                                            <i class="fas fa-eye mr-1"></i>Review
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Assignments Yet</h3>
                        <p class="text-gray-500">Student assignments will appear here for review.</p>
                    </div>
                @endif
            </div>

            <!-- Recent Activity Sidebar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-clock text-primary-600 mr-3"></i>Recent Activity
                    </h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Assignment approved for <span class="font-medium">Sarah Wilson</span></p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-upload text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">New assignment submitted by <span class="font-medium">John Doe</span></p>
                                <p class="text-xs text-gray-500">4 hours ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-certificate text-purple-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Certificate issued to <span class="font-medium">Mike Johnson</span></p>
                                <p class="text-xs text-gray-500">1 day ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-comment text-orange-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">New message from <span class="font-medium">Emma Davis</span></p>
                                <p class="text-xs text-gray-500">1 day ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-redo text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-900">Assignment revision requested for <span class="font-medium">Alex Brown</span></p>
                                <p class="text-xs text-gray-500">2 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="p-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-eye mr-2 text-primary-600"></i>View All Assignments
                        </button>
                        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-comment mr-2 text-secondary-600"></i>Message Students
                        </button>
                        <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-chart-bar mr-2 text-purple-600"></i>View Analytics
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection