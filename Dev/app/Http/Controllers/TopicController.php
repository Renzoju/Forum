<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function create(int $threadId): View
    {
        $thread = Thread::findOrFail($threadId);
        return view('topics.create', compact('thread'));
    }

    public function store(Request $request, int $threadId): RedirectResponse
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:200',
            'body' => 'required|string',
        ]);

        Topic::create([
            'thread_id' => $threadId,
            'titel' => $validated['titel'],
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.show', $threadId)
            ->with('success', 'Topic succesvol aangemaakt!');
    }

    public function show(int $id): View
    {
        $topic = Topic::with(['replies.user', 'thread', 'user'])->findOrFail($id);
        return view('topics.show', compact('topic'));
    }

    public function edit(int $id): View|RedirectResponse
    {
        $topic = Topic::findOrFail($id);

        if (!$this->canEdit($topic)) {
            return redirect()->route('topics.show', $topic->topic_id)
                ->with('error', 'Je mag deze topic niet bewerken.');
        }

        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $topic = Topic::findOrFail($id);


        if (!$this->canEdit($topic)) {
            return redirect()->route('topics.show', $topic->topic_id)
                ->with('error', 'Je mag deze topic niet bewerken.');
        }

        $validated = $request->validate([
            'titel' => 'required|string|max:200',
            'body' => 'required|string',
        ]);

        $topic->update($validated);

        return redirect()->route('topics.show', $topic->topic_id)
            ->with('success', 'Topic succesvol bijgewerkt!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $topic = Topic::findOrFail($id);


        if (!Auth::user()->isAdmin()) {
            return redirect()->route('topics.show', $topic->topic_id)
                ->with('error', 'Alleen admins kunnen topics verwijderen.');
        }

        $threadId = $topic->thread_id;
        $topic->delete();

        return redirect()->route('threads.show', $threadId)
            ->with('success', 'Topic succesvol verwijderd!');
    }


    private function canEdit(Topic $topic): bool
    {
        return Auth::id() === $topic->user_id || Auth::user()->isAdmin();
    }
}
