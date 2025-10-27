@extends('layouts.app') 

@section('title', 'Pengaturan Profil')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Pengaturan Profil</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Terjadi Kesalahan:</p>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Informasi Akun</h2>

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email (Tidak Dapat Diubah)</label>
                    <input type="email" id="email" value="{{ $user->email }}" disabled
                        class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm cursor-not-allowed">
                    @if(str_ends_with($user->email, '@gmail.com'))
                        <p class="text-xs text-red-500 mt-1">Email Gmail tidak dapat diganti.</p>
                    @endif
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary
                        @if(!$canUpdateName) bg-gray-100 cursor-not-allowed @endif"
                        @disabled(!$canUpdateName)>

                    @if(!$canUpdateName)
                        <p class="text-xs text-red-500 mt-1">
                            Anda terakhir mengganti nama pada {{ Carbon\Carbon::parse($user->updated_name_at)->format('d M Y') }}. 
                            Anda dapat menggantinya lagi setelah {{ Carbon\Carbon::parse($user->updated_name_at)->addDays(7)->format('d M Y') }}.
                        </p>
                    @else
                        <p class="text-xs text-gray-500 mt-1">Anda hanya dapat mengganti nama seminggu sekali.</p>
                    @endif
                </div>
            </div>

            <h2 class="text-xl font-semibold mt-8 mb-4 border-b pb-2">Ganti Password</h2>

            <div class="space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" autocomplete="new-password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
                
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" autocomplete="new-password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit"
                    class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-secondary transition duration-300">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection