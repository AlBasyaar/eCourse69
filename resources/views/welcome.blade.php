@extends('layouts.app')

@section('title', 'Welcome - Kursus Online')

@section('content')
<div class="bg-gradient-to-r from-primary to-secondary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Belajar Online dengan Mentor Terbaik
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90">
                Platform kursus online terpercaya dengan sertifikat resmi
            </p>
            <div class="space-x-4">
                @guest
                    <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Mulai Belajar
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition duration-300">
                        Login
                    </a>
                @else
                    @if(Auth::user()->role === 'student')
                        <a href="{{ route('student.dashboard') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Dashboard Siswa
                        </a>
                    @elseif(Auth::user()->role === 'mentor')
                        <a href="{{ route('mentor.dashboard') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Dashboard Mentor
                        </a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Dashboard Admin
                        </a>
                    @endif
                @endguest
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-video text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Video Berkualitas</h3>
            <p class="text-gray-600">Materi pembelajaran dalam bentuk video HD dengan penjelasan yang mudah dipahami</p>
        </div>
        <div class="text-center">
            <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Mentor Berpengalaman</h3>
            <p class="text-gray-600">Belajar langsung dari mentor yang berpengalaman di bidangnya</p>
        </div>
        <div class="text-center">
            <div class="bg-primary text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-certificate text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Sertifikat Resmi</h3>
            <p class="text-gray-600">Dapatkan sertifikat resmi setelah menyelesaikan kursus</p>
        </div>
    </div>
</div>
@endsection
