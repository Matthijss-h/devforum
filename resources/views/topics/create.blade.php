<x-layout>

<!-- Back Button -->
<div class="max-w-3xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl sm:text-2xl font-bold text-white">Create New Topic</h2>
        <a href="{{ route('threads.show', $thread) }}" class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition">
            Cancel
        </a>
    </div>
</div>

<!-- Thread Info -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
    <div class="bg-gray-800/50 rounded-lg p-4">
        <div class="flex items-center gap-3">
            <div class="size-10 flex-none rounded-full bg-indigo-600/30 flex items-center justify-center text-white font-semibold">
                {{ $thread->title[0] }}
            </div>
            <div>
                <p class="text-sm text-gray-400">Posting in</p>
                <p class="text-white font-semibold">{{ $thread->title }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Create Topic Form -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-gray-800/50 rounded-lg p-6">
        <form method="POST" action="{{ route('topics.store', $thread) }}">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                    Topic Title
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}"
                    class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    placeholder="What's your topic about?"
                    required
                    autofocus
                >
                @error('title')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Body -->
            <div class="mb-6">
                <label for="body" class="block text-sm font-medium text-gray-300 mb-2">
                    Description
                </label>
                <textarea 
                    id="body" 
                    name="body" 
                    rows="10"
                    class="w-full px-4 py-2 bg-gray-900 border border-gray-700 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                    placeholder="Provide details about your topic..."
                    required
                >{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('threads.show', $thread) }}" class="px-6 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-600 transition">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 transition font-medium"
                >
                    Create Topic
                </button>
            </div>
        </form>
    </div>
</div>

</x-layout>