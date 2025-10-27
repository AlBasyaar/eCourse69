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

    {{-- Definisikan status baru --}}
    @php
        $isAccepted = ($assignment->status === 'accepted');
        $isCertificateReady = ($assignment->status === 'certificate_ready');
        $isFinal = ($isCertificateReady || $assignment->status === 'rejected'); // Tugas yang sudah selesai di review (Ditolak atau Sertifikat Siap)
        $isEditable = ($assignment->status === 'pending' || $assignment->status === 'rejected');
    @endphp

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
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
                                <span class="text-yellow-600 font-medium">Menunggu Review</span>
                            @elseif($assignment->status === 'accepted')
                                <span class="text-blue-600 font-medium">Diterima (Menunggu Sertifikat)</span>
                            @elseif($assignment->status === 'rejected')
                                <span class="text-red-600 font-medium">Perlu Perbaikan</span>
                            @elseif($assignment->status === 'certificate_ready')
                                <span class="text-green-600 font-medium">Sertifikat Siap (Selesai)</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-file mr-2 text-primary"></i>
                    File Tugas
                </h2>
                
                @if($assignment->file_path)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-gray-400 text-2xl mr-4"></i>
                                <div>
                                    @php
                                        $fileName = basename($assignment->file_path);
                                        $displayFileName = (mb_strlen($fileName) > 30) ? mb_substr($fileName, 0, 10) . '...' . mb_substr($fileName, -15) : $fileName;
                                    @endphp
                                    <p class="font-medium text-gray-900">{{ $displayFileName }}</p>
                                    <p class="text-sm text-gray-500">File tugas siswa</p>
                                </div>
                            </div>
                            <a href="{{ Storage::url($assignment->file_path) }}" target="_blank" 
                               class="bg-primary text-white px-4 py-2 rounded text-sm hover:bg-secondary transition duration-300">
                                <i class="fas fa-download mr-2"></i>Download
                            </a>
                        </div>
                    </div>
                @else
                    <p class="text-gray-500">File tidak tersedia</p>
                @endif
            </div>

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

        <div class="lg:col-span-1">
            
            {{-- Form Beri Feedback/Status (Hanya aktif jika status pending/rejected) --}}
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-edit mr-2 text-primary"></i>
                    Berikan Feedback
                </h3>
                
                <form action="{{ route('mentor.assignments.feedback', $assignment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status" required
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-primary focus:border-primary
                                    {{ $isAccepted || $isCertificateReady ? 'bg-gray-100 border-gray-200 cursor-not-allowed text-gray-500' : 'border-gray-300' }}"
                                @disabled($isAccepted || $isCertificateReady)>
                                <option value="pending" {{ $assignment->status === 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                <option value="accepted" {{ $assignment->status === 'accepted' || $isCertificateReady ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ $assignment->status === 'rejected' ? 'selected' : '' }}>Perlu Perbaikan</option>
                            </select>
                            @if($isCertificateReady)
                                <p class="text-xs text-red-500 mt-1">Status sudah final (Sertifikat Siap).</p>
                            @endif
                        </div>

                        <div>
                            <label for="mentor_feedback" class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                            <textarea name="mentor_feedback" id="mentor_feedback" rows="6" required
                                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-primary focus:border-primary
                                    {{ $isAccepted || $isCertificateReady ? 'bg-gray-100 border-gray-200 cursor-not-allowed text-gray-500' : 'border-gray-300' }}"
                                placeholder="Berikan feedback untuk siswa..."
                                @disabled($isAccepted || $isCertificateReady)>{{ old('mentor_feedback', $assignment->mentor_feedback) }}</textarea>
                            @error('mentor_feedback')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full py-2 px-4 rounded transition duration-300 text-white
                                {{ $isAccepted || $isCertificateReady ? 'bg-gray-400 cursor-not-allowed' : 'bg-primary hover:bg-secondary' }}"
                            @disabled($isAccepted || $isCertificateReady)>
                            <i class="fas fa-{{ $isAccepted || $isCertificateReady ? 'lock' : 'save' }} mr-2"></i>
                            {{ $isAccepted ? 'Tugas Disetujui' : ($isCertificateReady ? 'Tugas Selesai' : 'Simpan Feedback') }}
                        </button>
                    </div>
                </form>
            </div>
            
            {{-- Form Upload Certificate (Hanya muncul jika status sudah accepted) --}}
            @if($isAccepted)
            <div class="bg-white border border-blue-200 rounded-lg shadow p-6 mt-6">
                <h3 class="text-lg font-bold text-blue-700 mb-4">
                    <i class="fas fa-upload mr-2"></i>
                    Upload Sertifikat (PNG/JPG)
                </h3>
                <p class="text-sm text-blue-600 mb-4">Sertifikat akan dikirim ke siswa setelah file diunggah.</p>
                <form action="{{ route('mentor.assignments.upload-certificate', $assignment) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-4">
                        <div>
                            <label for="certificate_file" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Sertifikat (.PNG/.JPG)</label>
                            <input type="file" name="certificate_file" id="certificate_file" required
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200"/>
                            @error('certificate_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300">
                            <i class="fas fa-cloud-upload-alt mr-2"></i>Unggah & Selesaikan Tugas
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Notifikasi Sertifikat Selesai --}}
            @if($isCertificateReady)
            @php
                // Kita asumsikan ada relasi assignment->certificate
                $certificate = $assignment->certificate()->first(); 
            @endphp
            <div class="bg-white border-l-4 border-green-500 text-green-700 p-6 mt-6 rounded-lg shadow">
                <p class="font-bold mb-2 flex items-center"><i class="fas fa-check-circle mr-2"></i> Sertifikat Telah Selesai</p>
                <p class="text-sm mb-4">Sertifikat telah diunggah dan siap diunduh oleh siswa.</p>
                
                @if($certificate && $certificate->certificate_path)
                    <a href="{{ Storage::url($certificate->certificate_path) }}" target="_blank"
                       class="inline-flex items-center bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700 transition duration-300">
                        <i class="fas fa-eye mr-2"></i>Lihat File Sertifikat
                    </a>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
@endsection