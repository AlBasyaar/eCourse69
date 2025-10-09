@extends('layouts.app')

@section('title', 'Kelola Kursus')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Kursus</h1>
                <p class="text-gray-600">Daftar semua kursus yang tersedia</p>
            </div>
            <a href="{{ route('admin.courses.create') }}"
                class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition duration-300">
                <i class="fas fa-plus mr-2"></i>Tambah Kursus
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($courses->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kursus</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mentor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Video</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($courses as $course)
                                <tr class="hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if ($course->thumbnail)
                                                <img class="h-12 w-12 rounded-lg object-cover mr-4"
                                                    src="{{ $course->thumbnail }}" alt="{{ $course->title }}">
                                            @else
                                                <div
                                                    class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center mr-4">
                                                    <i class="fas fa-book text-gray-400"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $course->title }}</div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit($course->description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $course->mentor?->user?->name ?? 'Mentor not found' }}</div>
                                        <div class="text-sm text-gray-500">{{ $course->mentor?->user?->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">Rp
                                            {{ number_format($course->price, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $course->videos_count ?? 0 }} video</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.courses.edit', $course) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.courses.delete', $course) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Yakin ingin menghapus kursus ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
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

                @if ($courses->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $courses->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <i class="fas fa-book text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kursus</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan kursus pertama</p>
                    <a href="{{ route('admin.courses.create') }}"
                        class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition duration-300">
                        <i class="fas fa-plus mr-2"></i>Tambah Kursus
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection