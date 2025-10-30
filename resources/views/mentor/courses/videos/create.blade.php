@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambahkan Video Baru</h1>
                    <p class="mt-2 text-gray-600">Unggah video dan materi pendukung untuk kursus: {{ $course->title }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            <div class="p-6">
                {{-- FORM DIBUAT ID UNTUK DIPROSES OLEH AJAX --}}
                <form id="uploadForm" action="{{ route('mentor.courses.videos.store', $course) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-video mr-2 text-blue-500"></i>Judul Video
                            </label>
                            <input type="text" 
                                    id="title" 
                                    name="title" 
                                    value="{{ old('title') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                                    placeholder="Masukkan judul video"
                                    required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-500"></i>Deskripsi
                            </label>
                            <textarea id="description" 
                                     name="description" 
                                     rows="4"
                                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                                     placeholder="Masukkan deskripsi video (opsional)">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="material_file" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-file-alt mr-2 text-green-500"></i>Upload Materi (PDF/Dokumen) - Opsional
                            </label>
                            <div id="material-dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-file-upload text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="material_file" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500">
                                            <span>Pilih file materi</span>
                                            <input id="material_file" name="material_file" type="file" class="sr-only" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt">
                                        </label>
                                        <p class="pl-1">atau seret dan letakkan</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF, DOC, PPT, XLS hingga 50MB</p>
                                </div>
                            </div>
                            <p id="material-preview" class="mt-2 text-sm font-medium text-left pl-2 flex items-center space-x-2"></p>
                            @error('material_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-upload mr-2 text-blue-500"></i>File Video Wajib
                            </label>
                            <div id="video-dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="video_file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>Pilih file video</span>
                                            <input id="video_file" name="video_file" type="file" class="sr-only" accept=".mp4,.mov,.avi,.wmv" required>
                                        </label>
                                        <p class="pl-1">atau seret dan letakkan</p>
                                    </div>
                                    <p class="text-xs text-gray-500">MP4, MOV, AVI, WMV hingga **500MB**</p>
                                </div>
                            </div>
                            <p id="video-preview" class="mt-2 text-sm font-medium text-left pl-2 flex items-center space-x-2"></p>
                            @error('video_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ELEMEN PROGRESS BAR BARU --}}
                    <div id="progress-container" class="mt-8 hidden">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                            <i class="fas fa-spinner fa-spin mr-2 text-blue-500"></i> Proses Upload...
                        </h3>
                        <div class="w-full bg-gray-200 rounded-full h-4">
                            <div id="progressBar" class="bg-blue-600 h-4 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                        <p id="progress-text" class="text-sm mt-1 text-gray-600 text-right">0%</p>
                    </div>
                    
                    {{-- AREA PESAN KESALAHAN/SUKSES AJAX --}}
                    <div id="message-area" class="mt-4"></div>

                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('mentor.courses.show', $course) }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg transition-colors hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" id="submitButton" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Video & Materi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- Elemen Form & Dropzone ---
    const uploadForm = document.getElementById('uploadForm');
    const submitButton = document.getElementById('submitButton');
    const videoDrop = document.getElementById('video-dropzone');
    const materialDrop = document.getElementById('material-dropzone');
    const videoInput = document.getElementById('video_file');
    const materialInput = document.getElementById('material_file');
    const videoPreview = document.getElementById('video-preview');
    const materialPreview = document.getElementById('material-preview');
    
    // --- Elemen Progress Bar ---
    const progressContainer = document.getElementById('progress-container');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progress-text');
    const messageArea = document.getElementById('message-area');

    // --- FUNGSI DROPZONE (SAMA SEPERTI SEBELUMNYA) ---
    const setupDropZone = (dropzone, input, previewElement, color = 'blue', type = 'file') => {
        const updatePreview = () => {
            if (input.files.length > 0) {
                const file = input.files[0];
                let icon = '';
                let iconColor = '';
                if (type === 'video') {
                    icon = 'fas fa-video';
                    iconColor = 'text-blue-600';
                } else {
                    icon = 'fas fa-file-alt';
                    iconColor = 'text-green-600';
                }
                previewElement.innerHTML = `<i class="${icon} ${iconColor}"></i> <span class="text-gray-800">${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</span>`;
            } else {
                previewElement.innerHTML = '';
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
            if (files.length > 0) {
                input.files = files;
                updatePreview();
            }
        });

        input.addEventListener('change', updatePreview);
    };

    setupDropZone(videoDrop, videoInput, videoPreview, 'blue', 'video');
    setupDropZone(materialDrop, materialInput, materialPreview, 'green', 'file');

    // --- LOGIC AJAX UNTUK UPLOAD DENGAN PROGRESS BAR ---
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah submit form biasa

        // 1. Reset tampilan
        messageArea.innerHTML = '';
        progressBar.style.width = '0%';
        progressText.textContent = '0%';
        progressContainer.classList.remove('hidden');
        
        // 2. Disable tombol submit
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengunggah...';

        const formData = new FormData(this);
        const url = this.action;
        
        const xhr = new XMLHttpRequest();

        // Event listener untuk memantau progres upload
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBar.style.width = percentComplete.toFixed(0) + '%';
                progressText.textContent = percentComplete.toFixed(0) + '%';
            }
        });

        // Event listener saat upload selesai
        xhr.onload = function() {
            // Re-enable tombol
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Video & Materi';
            
            // Sembunyikan progress bar
            progressContainer.classList.add('hidden');
            
            // 3. Tangani respons dari server
            if (xhr.status === 200 || xhr.status === 201) {
                // Berhasil
                const response = JSON.parse(xhr.responseText);
                messageArea.innerHTML = `<div class="bg-gray-700 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                            <p class="font-bold">Sukses!</p>
                                            <p>${response.message || 'Video dan materi berhasil ditambahkan.'}</p>
                                        </div>`;
                
                // Redirect ke halaman daftar video kursus setelah 2 detik
                setTimeout(() => {
                    window.location.href = response.redirect_url || "{{ route('mentor.courses.show', $course) }}";
                }, 2000);

            } else {
                // Gagal (Validasi atau Error Server)
                let errorMessage = 'Terjadi kesalahan saat mengunggah. Silakan coba lagi.';
                if (xhr.responseText) {
                    try {
                        const errorResponse = JSON.parse(xhr.responseText);
                        
                        if (xhr.status === 422 && errorResponse.errors) {
                            // Tampilkan error validasi Laravel
                            errorMessage = 'Gagal validasi: <ul class="list-disc list-inside mt-2">';
                            for (const key in errorResponse.errors) {
                                errorMessage += `<li>${errorResponse.errors[key][0]}</li>`;
                            }
                            errorMessage += '</ul>';
                        } else {
                            errorMessage = errorResponse.message || errorMessage;
                        }
                    } catch (e) {
                        // Jika respons bukan JSON
                        errorMessage = `Error Server (${xhr.status}). Periksa log server.`;
                    }
                }
                
                messageArea.innerHTML = `<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                                            <p class="font-bold">Gagal!</p>
                                            <p>${errorMessage}</p>
                                        </div>`;
            }
        };

        // Event listener jika terjadi error koneksi
        xhr.onerror = function() {
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Video & Materi';
            progressContainer.classList.add('hidden');
            messageArea.innerHTML = `<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                                        <p class="font-bold">Error Koneksi!</p>
                                        <p>Gagal terhubung ke server. Periksa koneksi internet Anda.</p>
                                    </div>`;
        };

        // 4. Kirim request
        xhr.open('POST', url);
        xhr.send(formData);
    });
});
</script>
@endsection