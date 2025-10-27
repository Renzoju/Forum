<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{

    public function store(Request $request, int $threadId, int $topicId): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        Reply::create([
            'topic_id' => $topicId,
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('topics.show', [$threadId, $topicId])
            ->with('success', 'Reply succesvol geplaatst!');
    }


    public function edit(int $threadId, int $topicId, int $replyId): View|RedirectResponse
    {
        $reply = Reply::findOrFail($replyId);

        if (!$this->canEdit($reply)) {
            return redirect()->route('topics.show', [$threadId, $topicId])
                ->with('error', 'Je mag deze reply niet bewerken.');
        }

        return view('replies.edit', compact('reply', 'threadId', 'topicId'));
    }


    public function update(Request $request, int $threadId, int $topicId, int $replyId): RedirectResponse
    {
        $reply = Reply::findOrFail($replyId);

        if (!$this->canEdit($reply)) {
            return redirect()->route('topics.show', [$threadId, $topicId])
                ->with('error', 'Je mag deze reply niet bewerken.');
        }

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $reply->update($validated);

        return redirect()->route('topics.show', [$threadId, $topicId])
            ->with('success', 'Reply succesvol bijgewerkt!');
    }

    // Alleen admin mag verwijderen (gewone users NIET!)
    public function destroy(int $threadId, int $topicId, int $replyId): RedirectResponse
    {
        $reply = Reply::findOrFail($replyId);

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('topics.show', [$threadId, $topicId])
                ->with('error', 'Alleen administrators kunnen replies verwijderen.');
        }

        $reply->delete();

        return redirect()->route('topics.show', [$threadId, $topicId])
            ->with('success', 'Reply succesvol verwijderd!');
    }


    private function canEdit(Reply $reply): bool
    {
        return Auth::id() === $reply->user_id || Auth::user()->isAdmin();
    }
}
