@extends('layouts.app')

@section('title', 'Chat Kursus: ' . $course->title)

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $course->title }}</h1>
                        <p class="text-gray-600">Chat Diskusi Kursus</p>
                    </div>
                    <a href="{{ route('student.courses.show', $course) }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-comments mr-2 text-primary"></i>
                    Diskusi
                </h2>
            </div>

            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto mb-6">
                    @forelse($chats->reverse() as $chat)
                        <div class="flex items-start space-x-3">
                            <div
                                class="h-8 w-8 rounded-full bg-primary text-white flex items-center justify-center text-sm">
                                {{ substr($chat->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="font-medium text-gray-900">{{ $chat->user->name }}</span>
                                    <span class="text-xs text-gray-500">
                                        @if ($chat->user->role === 'mentor')
                                            <i class="fas fa-chalkboard-teacher mr-1"></i>Mentor
                                        @elseif($chat->user->role === 'student')
                                            <i class="fas fa-user-graduate mr-1"></i>Siswa
                                        @endif
                                    </span>
                                    <span class="text-xs text-gray-500">{{ $chat->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-gray-800">{{ $chat->message }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-comment text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Belum ada pesan dalam diskusi ini</p>
                            <p class="text-sm text-gray-400">Mulai diskusi dengan mengirim pesan pertama</p>
                        </div>
                    @endforelse
                </div>

                <!-- Send Message Form -->
                <form method="POST" action="{{ route('chats.course.send', $course) }}" class="flex flex-col space-y-4">
                    @csrf
                    <div class="flex-1">
                        <textarea name="message" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary resize-none"
                            placeholder="Tulis pesan Anda..."></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full bg-primary text-white px-6 py-2 bg-blue-500 rounded-md hover:bg-secondary transition duration-300 block">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Auto scroll to bottom of chat
        document.addEventListener('DOMContentLoaded', function() {
            const chatContainer = document.querySelector('.max-h-96.overflow-y-auto');
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        });
    </script>
@endsection
