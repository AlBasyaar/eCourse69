@extends('layouts.app')

@section('title', 'Sertifikat Saya - Siswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($certificates as $certificate)
        @php
            // Ambil status tugas akhir terkait
            $assignment = $certificate->course->finalAssignments()->where('user_id', Auth::id())->first();
            $status = $assignment ? $assignment->status : null;
            
            $isReady = ($status === 'certificate_ready');
            $isPending = ($status === 'accepted'); // Status accepted sekarang berarti 'menunggu diunggah mentor'
            $statusText = $isReady ? 'Siap Diunduh' : ($isPending ? 'Menunggu Sertifikat Mentor' : 'Selesai');
            $statusColor = $isReady ? 'bg-green-500' : ($isPending ? 'bg-yellow-500' : 'bg-gray-500');
            $icon = $isReady ? 'fas fa-download' : ($isPending ? 'fas fa-clock' : 'fas fa-check');
        @endphp
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="h-48 bg-gradient-to-r from-yellow-400 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-certificate text-6xl text-white opacity-80"></i>
            </div>
            
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="ml-2 text-sm text-gray-600">Mentor: {{ $certificate->course->mentor->user->name ?? 'N/A' }}</span>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-500">
                        <i class="fas fa-calendar mr-1"></i>{{ $certificate->issued_at ? $certificate->issued_at->format('d M Y') : 'Tanggal Tidak Tersedia' }}
                    </span>
                    <span class="px-2 py-1 rounded-full text-xs font-medium text-white {{ $statusColor }}">
                        <i class="{{ $icon }} mr-1"></i>{{ $statusText }}
                    </span>
                </div>

                @if($isReady)
                    <a href="{{ route('student.certificates.download', $certificate) }}" 
                        class="block w-full bg-primary text-white text-center py-2 rounded hover:bg-secondary transition duration-300">
                        <i class="fas fa-download mr-2"></i>Download Sertifikat
                    </a>
                @else
                    <button disabled class="block w-full bg-gray-400 text-white text-center py-2 rounded cursor-not-allowed">
                        <i class="fas fa-clock mr-2"></i>Menunggu Mentor Upload
                    </button>
                @endif
            </div>
        </div>
        @empty
        @endforelse
    </div>

    </div>
@endsection