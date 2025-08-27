@extends('layouts.app')

@section('title', 'Sertifikat Saya - Siswa')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Sertifikat Saya</h1>
        <p class="text-gray-600">Koleksi sertifikat kursus yang telah Anda selesaikan</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($certificates as $certificate)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="h-48 bg-gradient-to-r from-yellow-400 to-yellow-600 flex items-center justify-center">
                <i class="fas fa-certificate text-6xl text-white opacity-80"></i>
            </div>
            
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $certificate->course->title }}</h3>
                <p class="text-gray-600 mb-4">Sertifikat penyelesaian kursus</p>
                
                <div class="flex items-center mb-4">
                    <div class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="ml-2 text-sm text-gray-600">Mentor: {{ $certificate->course->mentor->user->name }}</span>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-500">
<i class="fas fa-calendar mr-1"></i>{{ $certificate->issued_at ? $certificate->issued_at->format('d M Y') : 'Tanggal Tidak Tersedia' }}
                    </span>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-check mr-1"></i>Selesai
                    </span>
                </div>

                <a href="{{ route('student.certificates.download', $certificate) }}" 
                   class="block w-full bg-primary text-white text-center py-2 rounded hover:bg-secondary transition duration-300">
                    <i class="fas fa-download mr-2"></i>Download Sertifikat
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-certificate text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum Ada Sertifikat</h3>
            <p class="text-gray-600 mb-6">Selesaikan kursus untuk mendapatkan sertifikat</p>
            <a href="{{ route('student.courses.index') }}" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition duration-300">
                <i class="fas fa-search mr-2"></i>Jelajahi Kursus
            </a>
        </div>
        @endforelse
    </div>

    @if($certificates->hasPages())
    <div class="mt-8">
        {{ $certificates->links() }}
    </div>
    @endif
</div>
@endsection
