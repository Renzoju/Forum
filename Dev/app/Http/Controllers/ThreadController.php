<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index(): View
    {
        $threads = Thread::with('user')->latest()->get();
        return view('threads.index', compact('threads'));
    }

    public function create(): View
    {
        return view('threads.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:200',
            'beschrijving' => 'required|string',
        ]);

        Thread::create([
            'titel' => $validated['titel'],
            'beschrijving' => $validated['beschrijving'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('threads.index')
            ->with('success', 'Thread succesvol aangemaakt!');
    }

    public function show(int $id): View
    {
        $thread = Thread::with(['topics.user', 'user'])->findOrFail($id);
        return view('threads.show', compact('thread'));
    }

    public function edit(int $id): View|RedirectResponse
    {
        $thread = Thread::findOrFail($id);

        // only admin can change threads
        if (!$this->canEdit($thread)) {
            return redirect()->route('threads.index')
                ->with('error', 'Je mag deze thread niet bewerken.');
        }

        return view('threads.edit', compact('thread'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $thread = Thread::findOrFail($id);


        if (!$this->canEdit($thread)) {
            return redirect()->route('threads.index')
                ->with('error', 'Je mag deze thread niet bewerken.');
        }

        $validated = $request->validate([
            'titel' => 'required|string|max:200',
            'beschrijving' => 'required|string',
        ]);

        $thread->update($validated);

        return redirect()->route('threads.show', $thread->thread_id)
            ->with('success', 'Thread succesvol bijgewerkt!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $thread = Thread::findOrFail($id);

        // Alleen admin mag verwijderen (volgens opdracht)
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('threads.index')
                ->with('error', 'Alleen admins kunnen threads verwijderen.');
        }

        $thread->delete();

        return redirect()->route('threads.index')
            ->with('success', 'Thread succesvol verwijderd!');
    }

    // Helper method: check of user mag bewerken
    private function canEdit(Thread $thread): bool
    {
        return Auth::id() === $thread->user_id || Auth::user()->isAdmin();
    }
}
