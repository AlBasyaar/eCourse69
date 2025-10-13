@extends('layouts.app')

@section('content')
    <div class="min-h-screen  py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $otherUser->name }}</h1>
                            <p class="text-gray-600">
                                @if ($otherUser->role === 'mentor')
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>Mentor
                                @else
                                    <i class="fas fa-user-graduate mr-1"></i>Student
                                @endif
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('chats.mentor_chats.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Chats
                    </a>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="p-6">
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        @forelse($messages as $message)
                            <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div
                                    class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    <p
                                        class="text-xs mt-1 {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->format('M d, H:i') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="text-gray-500">
                                    <i class="fas fa-comments text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">No messages yet</p>
                                    <p class="text-sm">Start the conversation by sending a message below</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Send Message Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form action="{{ route('chats.mentor_chats.send', $otherUser) }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-4">
                            <div class="flex-1">
                                <textarea name="message" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                    placeholder="Type your message..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors block">
                                    <i class="fas fa-paper-plane"></i>
                                    <span class="ml-2">Send</span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
