<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store(Request $request, int $topicId): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        Reply::create([
            'topic_id' => $topicId,
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('topics.show', $topicId)
            ->with('success', 'Reply succesvol geplaatst!');
    }

    public function edit(int $id): View|RedirectResponse
    {
        $reply = Reply::findOrFail($id);


        if (!$this->canEdit($reply)) {
            return redirect()->route('topics.show', $reply->topic_id)
                ->with('error', 'Je mag deze reply niet bewerken.');
        }

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $reply = Reply::findOrFail($id);

        // Alleen eigenaar of admin mag bewerken
        if (!$this->canEdit($reply)) {
            return redirect()->route('topics.show', $reply->topic_id)
                ->with('error', 'Je mag deze reply niet bewerken.');
        }

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $reply->update($validated);

        return redirect()->route('topics.show', $reply->topic_id)
            ->with('success', 'Reply succesvol bijgewerkt!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $reply = Reply::findOrFail($id);


        if (!Auth::user()->isAdmin()) {
            return redirect()->route('topics.show', $reply->topic_id)
                ->with('error', 'Alleen admins kunnen replies verwijderen.');
        }

        $topicId = $reply->topic_id;
        $reply->delete();

        return redirect()->route('topics.show', $topicId)
            ->with('success', 'Reply succesvol verwijderd!');
    }


    private function canEdit(Reply $reply): bool
    {
        return Auth::id() === $reply->user_id || Auth::user()->isAdmin();
    }
}
