@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] border border-gray-800 rounded-lg shadow-md p-6">


                @if(session('success'))
                    <div class="mb-4 bg-green-900/30 border border-green-700 text-green-400 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <h1 class="text-2xl font-bold text-gray-100 mb-6">{{ $user->name }}</h1>

                <div class="space-y-3 text-gray-300">
                    <p><span class="font-semibold text-gray-400">Gebruikersnaam:</span> {{ $user->username }}</p>
                    <p><span class="font-semibold text-gray-400">E-mail:</span> {{ $user->email }}</p>
                    <p>
                        <span class="font-semibold text-gray-400">Rol:</span>
                        @if($user->is_admin)
                            <span class="text-red-500 font-semibold">Admin</span>
                        @else
                            <span class="text-gray-400">User</span>
                        @endif
                    </p>
                    <p><span class="font-semibold text-gray-400">Aangemaakt op:</span> {{ $user->created_at->format('d-m-Y H:i') }}</p>
                    <p><span class="font-semibold text-gray-400">Laatste update:</span> {{ $user->updated_at->format('d-m-Y H:i') }}</p>
                </div>

                <hr class="my-6 border-gray-800">

                <h3 class="text-xl font-semibold text-gray-100 mb-3">Activiteit</h3>
                <ul class="text-gray-300 space-y-2">
                    <li><span class="font-semibold text-gray-400">Threads:</span> {{ $stats['threads'] }}</li>
                    <li><span class="font-semibold text-gray-400">Topics:</span> {{ $stats['topics'] }}</li>
                    <li><span class="font-semibold text-gray-400">Reacties:</span> {{ $stats['replies'] }}</li>
                </ul>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('users.index') }}" class="text-gray-400 hover:text-gray-200 transition">
                        ← Terug naar overzicht
                    </a>

                    <a href="{{ route('users.edit', $user->user_id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold transition">
                        Bewerken
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
