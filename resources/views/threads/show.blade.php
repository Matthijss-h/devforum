<x-layout>


<!-- Breadcrumb Navigation -->
<div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
        <a href="{{ route('threads.index') }}" class="hover:text-white transition">Forums</a>
        <span>›</span>
        <a href="{{ route('threads.show', $thread) }}" class="hover:text-white transition">{{ $thread->title }}</a>
    </div>
</div>

<!-- Back to Threads Button -->
<div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl sm:text-2xl font-bold text-white">Category</h2>
        <a href="{{ route('threads.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition">
            Back to Threads
        </a>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
        <div class="bg-green-600/20 border border-green-600/30 rounded-lg p-4">
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    </div>
@endif

<!-- Thread Header -->
<div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-800/50 rounded-lg p-6 mb-4">
        <div class="flex items-start gap-4">
            <div class="size-16 flex-none rounded-full bg-indigo-600/30 flex items-center justify-center text-white font-bold text-2xl">
                {{ $thread->title[0] }}
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-white mb-2">{{ $thread->title }}</h1>
                <p class="text-gray-300 mb-3">{{ $thread->body }}</p>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span>Created by {{ $thread->user->name }}</span>
                    <span>•</span>
                    <span>{{ $thread->created_at->diffForHumans() }}</span>
                    <span>•</span>
                    <span>{{ $thread->topics->count() }} {{ Str::plural('topic', $thread->topics->count()) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Topics List -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-white">Topics</h2>
        @auth
        <a href="{{ route('topics.create', $thread) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition">
            New Topic
        </a>
        @endauth
    </div>

    @if($thread->topics->isEmpty())
        <div class="bg-gray-800/30 rounded-lg p-8 text-center">
            <p class="text-gray-400 mb-4">No topics yet. Be the first to start a discussion!</p>
            @auth
                <a href="{{ route('topics.create', $thread) }}" class="inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition">
                    Create First Topic
                </a>
            @endauth
        </div>
    @else
        <ul role="list" class="divide-y divide-white/5 bg-gray-800/10 rounded-md">
            @foreach($thread->topics as $topic)
            <li class="p-5 hover:bg-white/5 transition-colors">
                <a href="{{ route('topics.show', [$thread, $topic]) }}" class="flex gap-x-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($topic->user->name) }}&background=6366f1&color=fff" 
                         alt="{{ $topic->user->name }}" 
                         class="size-10 flex-none rounded-full">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-x-4">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-white hover:text-indigo-400 transition">{{ $topic->title }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    by {{ $topic->user->name }} • {{ $topic->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-white">{{ $topic->replies->count() }}</p>
                                <p class="text-xs text-gray-400">{{ Str::plural('reply', $topic->replies->count()) }}</p>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-gray-300 line-clamp-2">{{ $topic->body }}</p>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    @endif
</div>
</x-layout>