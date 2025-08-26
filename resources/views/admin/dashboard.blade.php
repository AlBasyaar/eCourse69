@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                    <p class="text-gray-600 mt-1">Manage your learning management system</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-crown mr-2"></i>Administrator
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
                        <p class="text-sm font-medium text-gray-600">Total Students</p>
                        <p class="text-2xl font-bold text-gray-900">1,234</p>
                        <p class="text-xs text-green-600"><i class="fas fa-arrow-up mr-1"></i>12% increase</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-secondary-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Mentors</p>
                        <p class="text-2xl font-bold text-gray-900">56</p>
                        <p class="text-xs text-green-600"><i class="fas fa-arrow-up mr-1"></i>8% increase</p>
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
                        <p class="text-sm font-medium text-gray-600">Total Courses</p>
                        <p class="text-2xl font-bold text-gray-900">89</p>
                        <p class="text-xs text-blue-600"><i class="fas fa-plus mr-1"></i>3 new this week</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-certificate text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Certificates Issued</p>
                        <p class="text-2xl font-bold text-gray-900">423</p>
                        <p class="text-xs text-green-600"><i class="fas fa-arrow-up mr-1"></i>15% increase</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Quick Actions Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-bolt text-primary-600 mr-3"></i>Quick Actions
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('admin.mentors') }}" class="group bg-gradient-to-r from-primary-50 to-primary-100 p-4 rounded-xl hover:from-primary-100 hover:to-primary-200 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Add Mentor</p>
                                    <p class="text-sm text-gray-600">Create new mentor account</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.courses') }}" class="group bg-gradient-to-r from-secondary-50 to-secondary-100 p-4 rounded-xl hover:from-secondary-100 hover:to-secondary-200 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-secondary-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Add Course</p>
                                    <p class="text-sm text-gray-600">Create new course</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="group bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Settings</p>
                                    <p class="text-sm text-gray-600">System configuration</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="group bg-gradient-to-r from-orange-50 to-orange-100 p-4 rounded-xl hover:from-orange-100 hover:to-orange-200 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Analytics</p>
                                    <p class="text-sm text-gray-600">View detailed reports</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Card -->
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
                                <i class="fas fa-user-plus text-green-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">New student registered: <span class="font-medium">John Doe</span></p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-book text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">New course created: <span class="font-medium">Advanced React Development</span></p>
                                <p class="text-xs text-gray-500">5 hours ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-certificate text-purple-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">Certificate issued to <span class="font-medium">Sarah Wilson</span></p>
                                <p class="text-xs text-gray-500">1 day ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-orange-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900">New mentor added: <span class="font-medium">Dr. Michael Chen</span></p>
                                <p class="text-xs text-gray-500">2 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Mentor Management Preview -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chalkboard-teacher text-primary-600 mr-3"></i>Mentor Management
                        </h2>
                        <a href="{{ route('admin.mentors') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    JS
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">John Smith</p>
                                    <p class="text-sm text-gray-500">Web Development</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-secondary-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    AR
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Alice Rodriguez</p>
                                    <p class="text-sm text-gray-500">Data Science</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    MC
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Michael Chen</p>
                                    <p class="text-sm text-gray-500">Mobile Development</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Management Preview -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-book text-primary-600 mr-3"></i>Course Management
                        </h2>
                        <a href="{{ route('admin.courses') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-code text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">React.js Fundamentals</p>
                                    <p class="text-sm text-gray-500">156 students enrolled</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-chart-line text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Data Analysis with Python</p>
                                    <p class="text-sm text-gray-500">89 students enrolled</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Active</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-white"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Mobile App Development</p>
                                    <p class="text-sm text-gray-500">67 students enrolled</p>
                                </div>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">Draft</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection