@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] border border-gray-800 rounded-lg shadow-md p-6">


                @if($errors->any())
                    <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 px-4 py-3 rounded">
                        <ul class="list-disc ml-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="text-2xl font-bold text-gray-100 mb-6">Gebruiker bewerken</h1>

                <form method="POST" action="{{ route('users.update', $user->user_id) }}">
                    @csrf
                    @method('PUT')


                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Naam *</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full bg-[#111317] border border-gray-700 text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>


                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Gebruikersnaam *</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username', $user->username) }}"
                            required
                            class="w-full bg-[#111317] border border-gray-700 text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>


                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">E-mail *</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full bg-[#111317] border border-gray-700 text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>


                    <div class="mb-6">
                        <label for="is_admin" class="block text-sm font-medium text-gray-300 mb-2">Rol *</label>
                        <select
                            id="is_admin"
                            name="is_admin"
                            class="w-full bg-[#111317] border border-gray-700 text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>User</option>
                            <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>


                    <div class="flex justify-between items-center">
                        <a href="{{ route('users.show', $user->user_id) }}" class="text-gray-400 hover:text-gray-200 transition">
                            Annuleren
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition"
                        >
                            Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
