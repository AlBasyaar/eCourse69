@extends('layouts.app')

@section('title', 'Edit Kursus')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center">
                <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Kursus</h1>
                    <p class="text-gray-600 text-sm sm:text-base">{{ $course->title }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8">
        <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-2"></i>Judul Kursus
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('title') border-red-500 @enderror"
                        placeholder="Masukkan judul kursus" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2"></i>Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="Masukkan deskripsi kursus">{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mentor -->
                <div>
                    <label for="mentor_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Mentor
                    </label>
                    <select name="mentor_id" id="mentor_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('mentor_id') border-red-500 @enderror" required>
                        <option value="">Pilih Mentor</option>
                        @foreach($mentors as $mentor)
                            <option value="{{ $mentor->id }}" {{ old('mentor_id', $course->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                {{ $mentor->user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('mentor_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-money-bill mr-2"></i>Harga (Rp)
                    </label>
                    <input type="number" name="price" id="price" value="{{ old('price', $course->price) }}" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('price') border-red-500 @enderror"
                        placeholder="0" required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Thumbnail -->
                @if($course->thumbnail)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-image mr-2"></i>Thumbnail Saat Ini
                    </label>
                    <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}" class="h-40 w-full sm:w-64 object-cover rounded-lg">
                </div>
                @endif

                <!-- New Thumbnail -->
                <div class="md:col-span-2">
                    <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-image mr-2"></i>{{ $course->thumbnail ? 'Ganti Thumbnail' : 'Thumbnail' }}
                    </label>
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('thumbnail') border-red-500 @enderror">
                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                    @error('thumbnail')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-end items-stretch sm:items-center gap-3 sm:space-x-4 mt-8">
                <a href="{{ route('admin.courses.index') }}" 
                   class="w-full sm:w-auto px-6 py-2 border border-gray-300 text-gray-700 rounded-lg text-center transition duration-300 ">
                    Batal
                </a>
                <button type="submit" 
                        class="w-full sm:w-auto px-6 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition duration-300">
                    <i class="fas fa-save mr-2"></i>Update Kursus
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
