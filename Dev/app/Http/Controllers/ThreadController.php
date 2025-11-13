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
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Alleen administrators kunnen threads aanmaken.');
        }

        return view('threads.create');
    }


    public function store(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('threads.index')
                ->with('error', 'Alleen administrators kunnen threads aanmaken.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
        ]);

        Thread::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
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

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('threads.index')
                ->with('error', 'Alleen administrators kunnen threads bewerken.');
        }

        return view('threads.edit', compact('thread'));


    }


    public function update(Request $request, int $id): RedirectResponse
    {
        $thread = Thread::findOrFail($id);

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('threads.index')
                ->with('error', 'Alleen administrators kunnen threads bewerken.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
        ]);

        $thread->update($validated);

        return redirect()->route('threads.show', $thread->thread_id)
            ->with('success', 'Thread succesvol bijgewerkt!');
    }


    public function destroy(int $id): RedirectResponse
    {
        $thread = Thread::findOrFail($id);

        if (!Auth::user()->isAdmin()) {
            return redirect()->route('threads.index')
                ->with('error', 'Alleen administrators kunnen threads verwijderen.');
        }

        $thread->delete();

        return redirect()->route('threads.index')
            ->with('success', 'Thread succesvol verwijderd!');
    }
}
