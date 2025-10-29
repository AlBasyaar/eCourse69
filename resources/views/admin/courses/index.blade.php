@extends('layouts.app')

@section('title', 'Kelola Kursus')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Kelola Kursus</h1>
            <p class="text-gray-600 text-sm sm:text-base">Daftar semua kursus yang tersedia</p>
        </div>
        <a href="{{ route('admin.courses.create') }}"
            class="bg-blue-700 text-white px-5 py-3 rounded-lg hover:bg-blue-800 transition duration-300 text-center">
            <i class="fas fa-plus mr-2"></i>Tambah Kursus
        </a>
    </div>

    <!-- Alert -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center text-sm sm:text-base">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if ($courses->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kursus
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mentor
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Video
                            </th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($courses as $course)
                            <tr class="hover:bg-gray-700 transition">
                                <!-- Kursus -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if ($course->thumbnail)
                                            <img class="h-12 w-12 sm:h-14 sm:w-14 rounded-lg object-cover mr-4"
                                                 src="{{ $course->thumbnail }}" alt="{{ $course->title }}">
                                        @else
                                            <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-lg bg-gray-200 flex items-center justify-center mr-4">
                                                <i class="fas fa-book text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div class="min-w-[120px]">
                                            <div class="text-sm sm:text-base font-medium text-gray-900">{{ $course->title }}</div>
                                            <div class="text-xs sm:text-sm text-gray-500">
                                                {{ Str::limit($course->description, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Mentor -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $course->mentor?->user?->name ?? 'Mentor tidak ditemukan' }}</div>
                                    <div class="text-xs sm:text-sm text-gray-500">{{ $course->mentor?->user?->email ?? '' }}</div>
                                </td>

                                <!-- Harga -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm sm:text-base font-semibold text-gray-900">
                                        Rp {{ number_format($course->price, 0, ',', '.') }}
                                    </div>
                                </td>

                                <!-- Video -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm sm:text-base text-gray-900">
                                        {{ $course->videos_count ?? 0 }} video
                                    </div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.courses.edit', $course) }}"
                                           class="text-indigo-600 hover:text-indigo-900 transition">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.courses.delete', $course) }}" method="POST" 
                                              class="inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($courses->hasPages())
                <div class="px-4 sm:px-6 py-4 border-t border-gray-200">
                    {{ $courses->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12 px-4">
                <i class="fas fa-book text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-lg sm:text-xl font-medium text-gray-900 mb-2">Belum ada kursus</h3>
                <p class="text-gray-500 mb-6 text-sm sm:text-base">Mulai dengan menambahkan kursus pertama</p>
                <a href="{{ route('admin.courses.create') }}"
                    class="bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800 transition duration-300 inline-block">
                    <i class="fas fa-plus mr-2"></i>Tambah Kursus
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
