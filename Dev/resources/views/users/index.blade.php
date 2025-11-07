<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikersbeheer') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">


                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <h1 class="text-2xl font-bold mb-4">Alle gebruikers</h1>

                @if($users->count() > 0)
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left border border-gray-200">Naam</th>
                            <th class="px-4 py-2 text-left border border-gray-200">Gebruikersnaam</th>
                            <th class="px-4 py-2 text-left border border-gray-200">E-mail</th>
                            <th class="px-4 py-2 text-left border border-gray-200">Rol</th>
                            <th class="px-4 py-2 text-left border border-gray-200">Aangemaakt op</th>
                            <th class="px-4 py-2 text-left border border-gray-200">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-200 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $user->username }}</td>
                                <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-200 px-4 py-2">
                                    @if($user->is_admin)
                                        <span class="text-red-600 font-semibold">Admin</span>
                                    @else
                                        <span class="text-gray-600">User</span>
                                    @endif
                                </td>
                                <td class="border border-gray-200 px-4 py-2">{{ $user->created_at->format('d-m-Y') }}</td>
                                <td class="border border-gray-200 px-4 py-2">
                                    <a href="{{ route('users.show', $user->user_id) }}"
                                       class="text-blue-600 hover:underline">Bekijken</a>

                                    @if(Auth::id() !== $user->user_id)
                                        <form action="{{ route('users.destroy', $user->user_id) }}" method="POST"
                                              class="inline ml-2"
                                              onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Verwijderen</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-500">Er zijn nog geen gebruikers geregistreerd.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
