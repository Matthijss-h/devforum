<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Show the form for creating a new topic.
     */
    public function create(Thread $thread)
    {
        return view('topics.create', compact('thread'));
    }

    /**
     * Store a newly created topic in storage.
     */
    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        $topic = $thread->topics()->create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('topics.show', [$thread, $topic])
            ->with('success', 'Topic created successfully!');
    }

    /**
     * Display the specified topic.
     */
    public function show(Thread $thread, Topic $topic)
    {
        // Load the topic with its replies and users
        $topic->load(['replies.user', 'user']);
        
        return view('topics.show', compact('thread', 'topic'));
    }

    /**
     * Show the form for editing the specified topic.
     */
    public function edit(Thread $thread, Topic $topic)
    {
        //
    }

    /**
     * Update the specified topic in storage.
     */
    public function update(Request $request, Thread $thread, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified topic from storage.
     */
    public function destroy(Thread $thread, Topic $topic)
    {
        //
    }
}