@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('mentor.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Review Assignment</h1>
                        <p class="text-gray-600 mt-1">Evaluate student submission</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if($assignment->status == 'submitted')
                        <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-clock mr-2"></i>Pending Review
                        </span>
                    @elseif($assignment->status == 'approved')
                        <span class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-check mr-2"></i>Approved
                        </span>
                    @else
                        <span class="bg-red-100 text-red-800 px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-redo mr-2"></i>Needs Revision
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Assignment Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Student & Course Info -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-info-circle text-primary-600 mr-3"></i>Assignment Details
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Student Info -->
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-primary-400 to-secondary-400 rounded-full flex items-center justify-center text-white text-xl font-semibold">
                                {{ substr($assignment->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $assignment->user->name }}</h3>
                                <p class="text-gray-500">{{ $assignment->user->email }}</p>
                                <p class="text-sm text-gray-400">Student</p>
                            </div>
                        </div>

                        <!-- Course Info -->
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $assignment->course->title }}</h3>
                                <p class="text-gray-500">Final Assignment</p>
                                <p class="text-sm text-gray-400">Submitted {{ $assignment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignment File -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-file-download text-primary-600 mr-3"></i>Submitted Files
                    </h2>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-file-archive text-primary-600 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Assignment File</h3>
                            <p class="text-gray-500 mb-4">{{ basename($assignment->file_path) }}</p>
                            <div class="flex items-center justify-center space-x-4">
                                <a href="{{ asset('storage/' . $assignment->file_path) }}" 
                                   target="_blank"
                                   class="bg-primary-600 text-white px-6 py-3 rounded-lg hover:bg-primary-700 transition-colors">
                                    <i class="fas fa-download mr-2"></i>Download File
                                </a>
                                <a href="{{ asset('storage/' . $assignment->file_path) }}" 
                                   target="_blank"
                                   class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-eye mr-2"></i>Preview
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Previous Feedback (if any) -->
                @if($assignment->mentor_feedback)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-comments text-primary-600 mr-3"></i>Previous Feedback
                        </h2>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $assignment->mentor_feedback }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Grading Panel -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-clipboard-check text-primary-600 mr-3"></i>Grade Assignment
                    </h2>
                </div>
                
                <form method="POST" action="{{ route('mentor.assignments.grade', $assignment->id) }}" class="p-6">
                    @csrf
                    
                    <!-- Status Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Assignment Status</label>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="approved" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300" {{ $assignment->status == 'approved' ? 'checked' : '' }}>
                                <span class="ml-3 flex items-center">
                                    <i class="fas fa-check text-green-600 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Approve</span>
                                </span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="revisi" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300" {{ $assignment->status == 'revisi' ? 'checked' : '' }}>
                                <span class="ml-3 flex items-center">
                                    <i class="fas fa-redo text-red-600 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Request Revision</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Feedback -->
                    <div class="mb-6">
                        <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">
                            Feedback & Comments
                        </label>
                        <textarea name="feedback" 
                                  id="feedback" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                  placeholder="Provide detailed feedback for the student...">{{ $assignment->mentor_feedback }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-primary-600 to-secondary-600 text-white py-3 px-4 rounded-lg hover:from-primary-700 hover:to-secondary-700 transition-all duration-300 transform hover:scale-105 font-medium">
                        <i class="fas fa-save mr-2"></i>Submit Review
                    </button>
                </form>

                <!-- Assignment Info -->
                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">Assignment Timeline</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Submitted:</span>
                            <span class="font-medium text-gray-900">{{ $assignment->created_at->format('M j, Y g:i A') }}</span>
                        </div>
                        @if($assignment->updated_at != $assignment->created_at)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Last Updated:</span>
                                <span class="font-medium text-gray-900">{{ $assignment->updated_at->format('M j, Y g:i A') }}</span>
                            </div>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">File Size:</span>
                            <span class="font-medium text-gray-900">{{ number_format(rand(1000, 5000)) }} KB</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection