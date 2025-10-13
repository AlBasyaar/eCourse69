@extends('layouts.app')

@section('content')
<div class="min-h-screen  py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Personal Chats</h1>
            <p class="mt-2 text-gray-600">
                @if(auth()->user()->role === 'student')
                    Your conversations with mentors
                @else
                    Your conversations with students
                @endif
            </p>
        </div>

        <!-- Chat List -->      
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            @forelse($chats as $chat)
                @php
                    $otherUser = $chat->sender_id === auth()->id() ? $chat->receiver : $chat->sender;
                @endphp
                <div class="border-b border-gray-200 last:border-b-0">
                    <a href="{{ route('chats.mentor_chats.show', $otherUser) }}" class="block p-6 hover:bg-gray-700 transition-colors">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-lg font-medium text-gray-900">{{ $otherUser->name }}</div>
                                    <div class="text-sm text-gray-500">
                                        @if($otherUser->role === 'mentor')
                                            <i class="fas fa-chalkboard-teacher mr-1"></i>Mentor
                                        @else
                                            <i class="fas fa-user-graduate mr-1"></i>Student
                                        @endif
                                    </div>
                                    @if($chat->message)
                                        <div class="text-sm text-gray-600 mt-1">
                                            {{ Str::limit($chat->message, 50) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500">
                                    {{ $chat->created_at->diffForHumans() }}
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 mt-2"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="text-gray-500">
                        <i class="fas fa-comments text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No conversations yet</p>
                        <p class="text-sm">
                            @if(auth()->user()->role === 'student')
                                Start a conversation with your mentors from course pages
                            @else
                                Students will be able to chat with you once they have assignments
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
