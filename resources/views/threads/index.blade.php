<x-layout>
<ul role="list" class="divide-y divide-white/5 max-w-3xl mx-auto mt-4 bg-gray-800/10 rounded-md p-2">
    @foreach($threads as $thread)
    <li class="flex justify-between gap-x-6 py-5">
    <div class="flex min-w-0 gap-x-4">
      <div class="size-12 flex-none rounded-full bg-indigo-600/30 flex items-center justify-center text-white font-semibold"> {{$thread->title[0]}}</div>
      <div class="min-w-0 flex-auto">
        <p class="text-sm/6 font-semibold text-white">{{ $thread->title }}</p>
        <p class="mt-1 truncate text-xs/5 text-gray-400">{{ $thread->body }} </p>
      </div>
    </div>
    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
      <p class="text-sm/6 text-white">{{ $thread->topics->count() }} posts</p>
      <p class="mt-1 text-xs/5 text-gray-400">
    @if ($thread->topics->isEmpty())
      No activity yet
    @else
      Last activity {{ $thread->topics->sortByDesc('updated_at')->first()->updated_at->diffForHumans() }}
    @endif
      </p>
    </div>
  </li>
  @endforeach

</ul>
</x-layout>