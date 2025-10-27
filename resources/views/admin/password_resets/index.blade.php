@extends('layouts.app') {{-- Pastikan ini mengacu pada layout admin Anda --}}

@section('title', 'Manajemen Permintaan Ganti Password')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Permintaan Ganti Password</h1>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Search Bar --}}
    <div class="mb-6">
        <form action="{{ route('admin.password.resets.index') }}" method="GET" class="flex items-center space-x-3 bg-white p-4 rounded-xl shadow-md">
            <input type="text" name="search" placeholder="Cari Nama atau Email..." 
                   value="{{ $search ?? '' }}"
                   class="border border-gray-300 p-3 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-150">
                Cari
            </button>
            <a href="{{ route('admin.password.resets.index') }}" class="text-gray-600 hover:text-gray-800 p-2 text-sm whitespace-nowrap">
                Reset Filter
            </a>
        </form>
    </div>

    {{-- Tabel Permintaan --}}
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Pengguna
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Diajukan Pada (Terbaru)
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $user)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">{{ $user->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">{{ $user->name }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-gray-600">
                                {{ $user->updated_at->format('d M Y H:i:s') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($user->password_reset_status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($user->password_reset_status === 'accepted') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($user->password_reset_status) }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                @if ($user->password_reset_status === 'pending')
                                    <div class="flex justify-center space-x-2">
                                        {{-- Tombol ACCEPT --}}
                                        <form action="{{ route('admin.password.resets.accept', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menerima permintaan ini? Password user akan diubah.');">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md text-xs font-medium hover:bg-green-600 transition shadow-md">
                                                <i class="fas fa-check-circle mr-1"></i> Accept
                                            </button>
                                        </form>

                                        {{-- Tombol REJECT --}}
                                        <form action="{{ route('admin.password.resets.reject', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menolak permintaan ini? Password TIDAK akan diubah.');">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md text-xs font-medium hover:bg-red-600 transition shadow-md">
                                                <i class="fas fa-times-circle mr-1"></i> Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-500 text-xs">Sudah diproses</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center bg-white text-gray-500 text-lg">
                                Tidak ada permintaan ganti password yang tertunda saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="p-5 border-t bg-gray-50">
            {{ $requests->links() }}
        </div>
    </div>
</div>
@endsection