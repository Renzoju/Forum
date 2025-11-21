<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Thread;
use App\Services\TopicService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    protected TopicService $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function create(int $threadId): View
    {
        $thread = Thread::findOrFail($threadId);
        return view('topics.create', compact('thread'));
    }

    public function store(Request $request, int $threadId): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string',
        ]);

        $this->topicService->create($threadId, $validated);

        return redirect()->route('threads.show', $threadId)
            ->with('success', 'Topic succesvol aangemaakt!');
    }

    public function show(int $threadId, int $topicId): View
    {
        $topic = Topic::with(['replies.user', 'thread', 'user'])->findOrFail($topicId);
        return view('topics.show', compact('topic'));
    }

    public function edit(int $threadId, int $topicId): View|RedirectResponse
    {
        $topic = Topic::findOrFail($topicId);

        if (!$this->topicService->canEdit($topic)) {
            return redirect()->route('topics.show', [$threadId, $topicId])
                ->with('error', 'Je mag deze topic niet bewerken.');
        }

        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, int $threadId, int $topicId): RedirectResponse
    {
        $topic = Topic::findOrFail($topicId);

        if (!$this->topicService->canEdit($topic)) {
            return redirect()->route('topics.show', [$threadId, $topicId])
                ->with('error', 'Je mag deze topic niet bewerken.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string',
        ]);

        $this->topicService->update($topic, $validated);

        return redirect()->route('topics.show', [$threadId, $topicId])
            ->with('success', 'Topic succesvol bijgewerkt!');
    }

    public function destroy(int $threadId, int $topicId): RedirectResponse
    {
        $topic = Topic::findOrFail($topicId);

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('topics.show', [$threadId, $topicId])
                ->with('error', 'Alleen administrators kunnen topics verwijderen.');
        }

        $this->topicService->delete($topic);

        return redirect()->route('threads.show', $threadId)
            ->with('success', 'Topic succesvol verwijderd!');
    }
}
