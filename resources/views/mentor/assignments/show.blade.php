@extends('layouts.app')

@section('title', 'Review Tugas - ' . $assignment->user->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <a href="{{ route('mentor.assignments.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Review Tugas Akhir</h1>
                <p class="text-gray-600">{{ $assignment->course->title }}</p>
            </div>
        </div>
    </div>

    @php
        $isGraded = in_array($assignment->status, ['accepted', 'rejected']);
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Assignment Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-info-circle mr-2 text-primary"></i>
                    Detail Tugas
                </h2>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-user text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">Siswa: {{ $assignment->user->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-book text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">Kursus: {{ $assignment->course->title }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">Tanggal Submit: {{ $assignment->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-flag text-gray-400 mr-3"></i>
                        <span class="text-sm text-gray-600">Status: 
                            @if($assignment->status === 'pending')
                                <span class="text-yellow-600">Menunggu Review</span>
                            @elseif($assignment->status === 'accepted')
                                <span class="text-green-600">Diterima</span>
                            @elseif($assignment->status === 'rejected')
                                <span class="text-red-600">Perlu Perbaikan</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Assignment File -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-file mr-2 text-primary"></i>
                    File Tugas
                </h2>
                
                @if($assignment->file_path)
                    <div class="border border-gray-200 rounded-lg p-10">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-gray-400 text-2xl mr-4"></i>
                                <div>
                                    @php
                                        $fileName = basename($assignment->file_path);
                                        $displayFileName = (mb_strlen($fileName) > 30) ? mb_substr($fileName, 0, 10) . '...' . mb_substr($fileName, -15) : $fileName;
                                    @endphp
                                    <p class="font-medium text-gray-900">{{ $displayFileName }}</p>
                                    <p class="text-sm text-gray-500 mb-5">File tugas siswa</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ Storage::url($assignment->file_path) }}" target="_blank" 
                           class="bg-primary text-white mt-5 px-4 py-2 rounded hover:bg-secondary transition duration-300">
                            <i class="fas fa-download mr-2"></i>Download
                        </a>
                    </div>
                @else
                    <p class="text-gray-500">File tidak tersedia</p>
                @endif
            </div>

            <!-- Current Feedback -->
            @if($assignment->mentor_feedback)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-comment mr-2 text-primary"></i>
                    Feedback Saat Ini
                </h2>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700">{{ $assignment->mentor_feedback }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Feedback Form -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-edit mr-2 text-primary"></i>
                    Berikan Feedback
                </h3>
                
                <form action="{{ route('mentor.assignments.feedback', $assignment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-primary focus:border-primary
                                    {{ $isGraded ? 'bg-gray-100 border-gray-200 cursor-not-allowed text-gray-500' : 'border-gray-300' }}"
                                @disabled($isGraded)>
                                <option value="pending" {{ $assignment->status === 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                <option value="accepted" {{ $assignment->status === 'accepted' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ $assignment->status === 'rejected' ? 'selected' : '' }}>Perlu Perbaikan</option>
                            </select>
                        </div>

                        <!-- Feedback -->
                        <div>
                            <label for="mentor_feedback" class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                            <textarea name="mentor_feedback" id="mentor_feedback" rows="6" required
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-primary focus:border-primary
                                    {{ $isGraded ? 'bg-gray-100 border-gray-200 cursor-not-allowed text-gray-500' : 'border-gray-300' }}"
                                placeholder="Berikan feedback untuk siswa..."
                                @disabled($isGraded)>{{ old('mentor_feedback', $assignment->mentor_feedback) }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-2 px-4 rounded transition duration-300
                                {{ $isGraded ? 'bg-gray-400 cursor-not-allowed' : 'bg-primary hover:bg-secondary' }}"
                            @disabled($isGraded)>
                            <i class="fas fa-{{ $isGraded ? 'lock' : 'save' }} mr-2"></i>
                            {{ $isGraded ? 'Tugas Kursus Telah Disetujui' : 'Simpan Feedback' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection