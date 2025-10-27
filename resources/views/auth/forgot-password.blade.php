@extends('layouts.app')

@section('title', 'Lupa Password - Kursus Online')

@section('content')
<style>
/* Style background seperti halaman login */
body {
    background-image: linear-gradient(to bottom right, #363BB0, #38B4FF, #8858EE);
    margin: 0;
    padding: 0;
}
</style>
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl flex max-w-4xl w-full overflow-hidden">
        
        {{-- Sisi Kiri (Formulir) --}}
        <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center relative">
            
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Lupa Password</h1>
                    <p class="text-gray-600">Masukkan Email dan Password Baru yang Diinginkan</p>
                </div>
                
                {{-- Tampilkan pesan status setelah pengiriman --}}
                @if (session('status'))
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded" role="alert">
                        <p class="font-bold">Informasi</p>
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                <form class="space-y-6" method="POST" action="{{ route('password.request.submit') }}">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" name="email" type="email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror" 
                               placeholder="masukkan email" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">Password Baru yang Diinginkan</label>
                        <input id="new_password" name="new_password" type="password" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('new_password') border-red-500 @enderror" 
                               placeholder="minimal 8 karakter">
                        @error('new_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                        <input id="new_password_confirmation" name="new_password_confirmation" type="password" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               placeholder="ulangi password baru">
                    </div>

                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Ajukan Perubahan Password
                    </button>

                    <div class="text-center pt-4">
                        <p class="text-sm text-gray-600">
                            Ingat akun Anda?
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                Kembali ke Masuk
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sisi Kanan (Ilustrasi) --}}
        <div class="hidden lg:flex lg:w-1/2 from-blue-50 to-purple-50 items-center justify-center p-4 relative">
            <div class="absolute top-6 right-6 z-10">
                <img src="https://res.cloudinary.com/dr5pehdsw/image/upload/v1752056700/69_uq1r75.png" alt="School Logo" class="w-16 h-16 object-contain">
            </div>
            
            <div class="w-full h-full flex flex-col items-center justify-center text-center space-y-4">
                <div class="flex-1 flex items-center justify-center">
                    <img src="https://res.cloudinary.com/dr5pehdsw/image/upload/v1756307010/rafiki_gmpthz.png" alt="Reset Password Illustration" class="w-full h-full max-w-none object-contain">
                </div>
                
                <div class="space-y-2 pb-8">
                    <h2 class="text-xl font-bold text-gray-900">Proses Verifikasi</h2>
                    <p class="text-gray-600 text-sm px-4 leading-relaxed">
                        Password baru Anda akan diterapkan setelah disetujui oleh Administrator.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection