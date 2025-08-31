@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-8">
<div class="max-w-4xl mx-auto">
<!-- Header -->
<div class="flex items-center justify-between mb-8">
<div>
<h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Berikan Akses Kursus</h1>
<p class="mt-2 text-lg text-gray-600">Berikan akses kursus kepada siswa.</p>
</div>
<a href="{{ route('admin.course_accesses.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-full shadow-lg hover:bg-gray-700 transition-transform transform hover:scale-105">
<i class="fas fa-arrow-left mr-3"></i>
Kembali ke Manajemen Akses
</a>
</div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200">
        <div class="p-8">
            <form action="{{ route('admin.course_accesses.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Student -->
                    <div>
                        <label for="user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user-graduate mr-2 text-blue-500"></i>Pilih Siswa
                        </label>
                        <select id="user_id" 
                                name="user_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-colors @error('user_id') border-red-500 @enderror"
                                required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course -->
                    <div>
                        <label for="course_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-book mr-2 text-blue-500"></i>Pilih Kursus
                        </label>
                        <select id="course_id" 
                                name="course_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-colors @error('course_id') border-red-500 @enderror"
                                required>
                            <option value="">-- Pilih Kursus --</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2">
                        <label for="is_active" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-2 text-blue-500"></i>Status Akses
                        </label>
                        <select id="is_active" 
                                name="is_active" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-500 transition-colors @error('is_active') border-red-500 @enderror"
                                required>
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('is_active')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-10 flex justify-end space-x-4">
                    <a href="{{ route('admin.course_accesses.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-full hover:bg-gray-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 transition-transform transform hover:scale-105">
                        <i class="fas fa-plus mr-2"></i>
                        Berikan Akses
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection