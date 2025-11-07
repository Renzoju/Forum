<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(): View
    {

        $users = User::select('user_id', 'name', 'username', 'email', 'is_admin', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.index', compact('users'));
    }


    public function show(int $id): View
    {
        $user = User::findOrFail($id);


        $stats = [
            'threads' => $user->threads()->count(),
            'topics' => $user->topics()->count(),
            'replies' => $user->replies()->count(),
        ];

        return view('users.show', compact('user', 'stats'));
    }


    public function edit(int $id): View
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }


    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $id . ',user_id',
            'email' => 'required|email|max:100|unique:users,email,' . $id . ',user_id',
            'is_admin' => 'required|boolean',
        ]);

        $user->update($validated);

        return redirect()->route('users.show', $id)
            ->with('success', 'User succesvol bijgewerkt!');
    }


    public function destroy(int $id): RedirectResponse
    {
        $user = User::findOrFail($id);


        if ($user->user_id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Je kunt jezelf niet verwijderen!');
        }


        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User succesvol verwijderd!');
    }
}
