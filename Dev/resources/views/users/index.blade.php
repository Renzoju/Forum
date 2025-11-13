@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] border border-gray-800 rounded-lg shadow-md p-6">


                @if(session('success'))
                    <div class="mb-4 bg-green-900/30 border border-green-700 text-green-400 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-blue-400">Gebruikersbeheer</h1>
                    <p class="text-gray-400 text-sm">Totaal: {{ $users->count() }} gebruikers</p>
                </div>

                @if($users->count() > 0)
                    <div class="overflow-x-auto rounded-lg border border-gray-800">
                        <table class="min-w-full text-sm text-left text-gray-300">
                            <thead class="bg-[#111216] text-gray-400 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-5 py-3">Naam</th>
                                <th class="px-5 py-3">Gebruikersnaam</th>
                                <th class="px-5 py-3">E-mail</th>
                                <th class="px-5 py-3">Rol</th>
                                <th class="px-5 py-3">Aangemaakt op</th>
                                <th class="px-5 py-3 text-center">Acties</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-800 bg-[#181a1f]">
                            @foreach($users as $user)
                                <tr class="hover:bg-[#20232b] transition">
                                    <td class="px-5 py-3 font-medium text-gray-200">{{ $user->name }}</td>
                                    <td class="px-5 py-3">{{ $user->username }}</td>
                                    <td class="px-5 py-3 text-gray-400">{{ $user->email }}</td>
                                    <td class="px-5 py-3">
                                        @if($user->is_admin)
                                            <span class="text-red-400 font-semibold">Admin</span>
                                        @else
                                            <span class="text-gray-400">User</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>

                                    <td class="px-5 py-3 text-center">
                                        <a href="{{ route('users.show', $user->user_id) }}"
                                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-xs font-medium shadow-blue-500/30 hover:shadow-blue-400/40 transition">
                                            Bekijken
                                        </a>

                                        @if(Auth::id() !== $user->user_id)
                                            <form action="{{ route('users.destroy', $user->user_id) }}" method="POST"
                                                  class="inline-block ml-2"
                                                  onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded text-xs font-medium shadow-red-500/30 hover:shadow-red-400/40 transition">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm mt-4">Er zijn nog geen gebruikers geregistreerd.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
