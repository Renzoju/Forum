<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruiker Details') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">


                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <h1 class="text-2xl font-bold mb-4">{{ $user->name }}</h1>

                <ul class="text-gray-700 space-y-2">
                    <li><strong>Gebruikersnaam:</strong> {{ $user->username }}</li>
                    <li><strong>E-mail:</strong> {{ $user->email }}</li>
                    <li><strong>Rol:</strong>
                        @if($user->is_admin)
                            <span class="text-red-600 font-semibold">Admin</span>
                        @else
                            <span class="text-gray-600">User</span>
                        @endif
                    </li>
                    <li><strong>Aangemaakt op:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</li>
                    <li><strong>Laatste update:</strong> {{ $user->updated_at->format('d-m-Y H:i') }}</li>
                </ul>

                <hr class="my-6">

                <h3 class="text-xl font-semibold mb-3">Activiteit</h3>
                <ul class="text-gray-700">
                    <li>📄 Threads: <strong>{{ $stats['threads'] }}</strong></li>
                    <li>🗨️ Topics: <strong>{{ $stats['topics'] }}</strong></li>
                    <li>💬 Reacties: <strong>{{ $stats['replies'] }}</strong></li>
                </ul>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-800">
                        ← Terug naar overzicht
                    </a>

                    <a href="{{ route('users.edit', $user->user_id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Bewerken
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
