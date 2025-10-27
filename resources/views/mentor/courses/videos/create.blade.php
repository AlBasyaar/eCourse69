@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add New Video</h1>
                    <p class="mt-2 text-gray-600">Upload a new video to {{ $course->title }}</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6">
                <form action="{{ route('mentor.courses.videos.store', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Video Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-video mr-2 text-blue-500"></i>Video Title
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                                   placeholder="Enter video title"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Video Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>Description
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                                      placeholder="Enter video description (optional)">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="material_file" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-file-alt mr-2 text-green-500"></i>Upload Materi (PDF/Dokumen)
                            </label>
                            <div id="material-dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-file-upload text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="material_file" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500">
                                            <span>Upload a material file</span>
                                            <input id="material_file" name="material_file" type="file" class="sr-only" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, DOC, PPT, XLS up to 50MB</p>
                                </div>
                            </div>
                            @error('material_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Video File -->
                        <div>
                            <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-upload mr-2 text-blue-500"></i>Video File
                            </label>
                            <div id="video-dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="video_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>Upload a video file</span>
                                            <input id="video_file" name="video_file" type="file" class="sr-only" accept=".mp4,.mov,.avi,.wmv" required>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">MP4, MOV, AVI, WMV up to 500MB</p>
                                </div>
                            </div>
                            @error('video_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Upload Materi -->

                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('mentor.courses.show', $course) }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-upload mr-2"></i>
                            Upload Video & Materi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Drag & Drop Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const videoDrop = document.getElementById('video-dropzone');
    const materialDrop = document.getElementById('material-dropzone');
    const videoInput = document.getElementById('video_file');
    const materialInput = document.getElementById('material_file');

    const setupDropZone = (dropzone, input, color = 'blue', type = 'file') => {
        const preview = document.createElement('p');
        preview.className = 'mt-2 text-sm font-medium text-left pl-2 flex items-center space-x-2';
        dropzone.insertAdjacentElement('afterend', preview);

        const updatePreview = () => {
            if (input.files.length > 0) {
                const file = input.files[0];
                const icon = type === 'video'
                    ? '<i class="fas fa-video text-blue-600"></i>'
                    : '<i class="fas fa-file-alt text-green-600"></i>';
                preview.innerHTML = `${icon} <span class="text-gray-800">${file.name}</span>`;
            } else {
                preview.innerHTML = '';
            }
        };

        ['dragenter', 'dragover'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                dropzone.classList.add(`border-${color}-500`, `bg-${color}-50`);
            });
        });

        ['dragleave', 'drop'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                dropzone.classList.remove(`border-${color}-500`, `bg-${color}-50`);
            });
        });

        dropzone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            input.files = files;
            updatePreview();
        });

        input.addEventListener('change', updatePreview);
    };

    setupDropZone(videoDrop, videoInput, 'blue', 'video');
    setupDropZone(materialDrop, materialInput, 'green', 'file');
});
</script>
@endsection