@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen font-inter">
    <!-- Header Section -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Mentor Management</h1>
                    <p class="text-gray-600 mt-1">Manage mentors and their permissions</p>
                </div>
                <!-- Button to open the 'Add New Mentor' modal -->
                <button 
                    x-data @click="$dispatch('open-create-modal')" 
                    class="mt-4 sm:mt-0 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Add New Mentor
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Message Alert (placeholder) -->
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

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Mentors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $mentors->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-check text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Mentors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $mentors->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Students Mentored</p>
                        <p class="text-2xl font-bold text-gray-900">1,234</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mentors Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">All Mentors</h2>
            </div>
            
            @if($mentors->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mentor</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($mentors as $mentor)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ substr($mentor->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $mentor->user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $mentor->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $mentor->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Web Development</div>
                                        <div class="text-sm text-gray-500">Frontend & Backend</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ rand(10, 50) }} students</div>
                                        <div class="text-sm text-gray-500">{{ rand(5, 15) }} courses</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-circle text-green-400 mr-1" style="font-size: 6px;"></i>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="#" class="text-purple-600 hover:text-purple-900 transition-colors">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button 
                                                x-data 
                                                @click="$dispatch('open-edit-mentor', { id: {{ $mentor->user->id }}, name: '{{ $mentor->user->name }}', email: '{{ $mentor->user->email }}' })" 
                                                class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button 
                                                x-data 
                                                @click="$dispatch('open-delete-mentor', { id: {{ $mentor->user->id }}, name: '{{ $mentor->user->name }}' })" 
                                                class="text-red-600 hover:text-red-900 transition-colors">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-chalkboard-teacher text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Mentors Found</h3>
                    <p class="text-gray-500 mb-6">Get started by adding your first mentor to the platform.</p>
                    <button 
                        x-data 
                        @click="$dispatch('open-create-modal')" 
                        class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add First Mentor
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah Mentor (Add New Mentor) -->
    <div 
        x-data="{ createModalOpen: false }" 
        x-on:open-create-modal.window="createModalOpen = true" 
        x-show="createModalOpen" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
        <div @click.away="createModalOpen = false" class="relative bg-white rounded-2xl shadow-lg w-11/12 md:w-3/4 lg:w-1/2 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Add New Mentor</h3>
                <button @click="createModalOpen = false" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form method="POST" action="{{ route('admin.mentors.create') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-purple-600 mr-2"></i>Full Name
                        </label>
                        <input type="text" name="name" id="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" placeholder="Enter mentor's full name">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-purple-600 mr-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" placeholder="Enter email address">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-600 mr-2"></i>Password
                    </label>
                    <input type="password" name="password" id="password" required minlength="8" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" placeholder="Create a secure password (min. 8 characters)">
                    <p class="text-xs text-gray-500 mt-1">Password should be at least 8 characters long</p>
                </div>
                <div class="flex items-center justify-end space-x-4 pt-6">
                    <button type="button" @click="createModalOpen = false" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>Create Mentor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Mentor -->
    <div 
        x-data="{ mentorId: '', name: '', email: '', open: false }"
        x-on:open-edit-mentor.window="mentorId = $event.detail.id; name = $event.detail.name; email = $event.detail.email; open = true;"
        x-show="open" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
        <div @click.away="open = false" class="relative bg-white rounded-2xl shadow-lg w-11/12 md:w-3/4 lg:w-1/2 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Update Mentor</h3>
                <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form :action="`/admin/mentors/${mentorId}`" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-purple-600 mr-2"></i>Full Name
                        </label>
                        <input type="text" name="name" id="edit_name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" x-model="name">
                    </div>
                    <div>
                        <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-purple-600 mr-2"></i>Email Address
                        </label>
                        <input type="email" name="email" id="edit_email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" x-model="email">
                    </div>
                </div>
                <div>
                    <label for="edit_password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-purple-600 mr-2"></i>New Password (Optional)
                    </label>
                    <input type="password" name="password" id="edit_password" minlength="8" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" placeholder="Enter new password (min. 8 characters)">
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current password.</p>
                </div>
                <div class="flex items-center justify-end space-x-4 pt-6">
                    <button type="button" @click="open = false" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Mentor (Delete Mentor) -->
    <div 
        x-data="{ mentorId: '', name: '', open: false }" 
        x-on:open-delete-mentor.window="mentorId = $event.detail.id; name = $event.detail.name; open = true;"
        x-show="open" 
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center">
        <div @click.away="open = false" class="relative bg-white rounded-2xl shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6 text-center">
            <i class="fas fa-exclamation-triangle text-red-500 text-4xl mx-auto mb-4"></i>
            <h3 class="text-xl leading-6 font-medium text-gray-900">Confirm Deletion</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    Are you sure you want to delete the mentor "<span class="font-bold" x-text="name"></span>"? This will also delete their associated mentor profile. This action cannot be undone.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form :action="`/admin/mentors/${mentorId}`" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Yes, Delete
                    </button>
                </form>
                <button @click="open = false" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors ml-2">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
