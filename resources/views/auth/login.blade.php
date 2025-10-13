@extends('layouts.app')

@section('title', 'Login - Kursus Online')

@section('content')
<style>
body {
    background-image: linear-gradient(to bottom right, #363BB0, #38B4FF, #8858EE);
    margin: 0;
    padding: 0;
}
</style>
<div class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl flex max-w-4xl w-full overflow-hidden">
        
        <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center relative">
            
            <div class="space-y-6">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Masuk</h1>
                    <p class="text-gray-600">Masuk ke akun Anda</p>
                </div>
                
                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" name="email" type="email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror" 
                               placeholder="masukkan email" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror" 
                               placeholder="masukkan password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 text-gray-700">
                                Ingatkan Saya
                            </label>
                        </div>
                        <a href="#" class="text-blue-600 hover:text-blue-500 transition-colors">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-medium rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Masuk
                    </button>

                    <!-- Link to Register -->
                    <div class="text-center pt-4">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                Daftar
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Illustration Section - Right Side -->
        <div class="hidden lg:flex lg:w-1/2 from-blue-50 to-purple-50 dark:from-gray-900 dark:to-purple-900/40 items-center justify-center p-4 relative">
            <!-- Logo positioned at top right of illustration -->
            <div class="absolute top-6 right-6 z-10">
                <img src="https://res.cloudinary.com/dr5pehdsw/image/upload/v1752056700/69_uq1r75.png" alt="School Logo" class="w-16 h-16 object-contain">
            </div>
            
            <div class="w-full h-full flex flex-col items-center justify-center text-center space-y-4">
                <!-- Main Illustration -->
                <div class="flex-1 flex items-center justify-center">
                    <img src="https://res.cloudinary.com/dr5pehdsw/image/upload/v1756307010/rafiki_gmpthz.png" alt="Login Illustration" class="w-full h-full max-w-none object-contain">
                </div>
                
                <!-- Welcome Text -->
                <div class="space-y-2 pb-8">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-800">Selamat Datang Kembali!</h2>
                    <p class="text-gray-600 text-sm px-4 leading-relaxed">
                        Masuk ke akun Anda untuk melanjutkan pembelajaran
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection