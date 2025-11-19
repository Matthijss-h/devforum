<x-layout>
    <!-- Breadcrumb Navigation -->
    <div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm text-gray-400 mb-4">
            <a href="{{ route('threads.index') }}" class="hover:text-white transition">Forums</a>
            <span>›</span>
            <a href="{{ route('threads.show', $thread) }}" class="hover:text-white transition">{{ $thread->title }}</a>
            <span>›</span>
            <span class="text-white">{{ $topic->title }}</span>
        </div>
    </div>

    <!-- Back to Threads Button -->
    <div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl sm:text-2xl font-bold text-white">Topic</h2>
            <a href="{{ route('threads.show', $thread) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition">
                Back to Topics
            </a>
        </div>
    </div>

    <!-- Topic Post -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="bg-gray-800/50 rounded-lg p-6">
            <!-- Header with actions -->
            <div class="flex items-start justify-between mb-4">
                <h1 class="text-2xl font-bold text-white">{{ $topic->title }}</h1>
            </div>

            <!-- Author Info -->
            <div class="flex items-center gap-3 mb-4">
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($topic->user->name) }}&background=6366f1&color=fff"
                    alt="{{ $topic->user->name }}"
                    class="size-10 rounded-full"
                >
                <div>
                    <p class="text-white font-medium">{{ $topic->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $topic->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Topic Body -->
            <div class="prose prose-invert max-w-none">
                <p class="text-gray-300 whitespace-pre-wrap">{{ $topic->body }}</p>
            </div>
        </div>
    </div>

    <!-- Replies Section Header -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-white">
                {{ $topic->replies->count() }} {{ Str::plural('Reply', $topic->replies->count()) }}
            </h2>
        </div>
    </div>

@auth
    <!-- Create Reply -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="bg-gray-800/50 rounded-lg p-6">
            <form method="POST" action="{{ route('replies.store', [$thread, $topic]) }}">
                @csrf

                <!-- Body -->
                <div class="mb-6">
                    <label for="body" class="block text-sm font-medium text-gray-300 mb-2">
                        Your Reply
                    </label>
                    <textarea
                        id="body"
                        name="body"
                        rows="3"
                        class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none overflow-hidden"
                        placeholder="Enter your reply here..."
                        oninput="this.style.height = 'auto'; this.style.height = (this.scrollHeight) + 'px'"
                        required
                    >{{ old('body') }}</textarea>

                    @error('body')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-3">
                    <button
                        class="flex items-center bg-blue-500 text-white gap-1 px-4 py-2 cursor-pointer text-gray-800 font-semibold tracking-widest rounded-md hover:bg-blue-400 duration-300 hover:gap-2 hover:translate-x-3"
                    >
                        Send
                        <svg
                            class="w-5 h-5"
                            stroke="currentColor"
                            stroke-width="1.5"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"
                                stroke-linejoin="round"
                                stroke-linecap="round"
                            ></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endauth

    <!-- Replies List -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        @if($topic->replies->isEmpty())
            <div class="bg-gray-800/30 rounded-lg p-8 text-center">
                <p class="text-gray-400">No replies yet. Be the first to respond!</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($topic->replies as $reply)
                    <div class="bg-gray-800/50 rounded-lg p-6">
                        <!-- Reply Author -->
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background=6366f1&color=fff"
                                    alt="{{ $reply->user->name }}"
                                    class="size-8 rounded-full"
                                >
                                <div>
                                    <p class="text-white font-medium text-sm">{{ $reply->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Reply Body -->
                        <p class="text-gray-300 whitespace-pre-wrap">{{ $reply->body }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>