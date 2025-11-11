@extends('layouts.forum')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-[#0f1115]">
        <div class="bg-[#1a1c22] border border-gray-800 rounded-xl shadow-lg p-8 w-full max-w-md">


            <div class="flex justify-center mb-6">
                <a href="{{ route('home') }}" class="text-3xl font-bold tracking-tight">
                    <span class="text-blue-500">Dev</span><span class="text-white">forum</span><span class="text-blue-500">.</span>
                </a>
            </div>

            <h2 class="text-center text-2xl font-semibold text-gray-100 mb-6">
                Maak een nieuw account
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-300 text-sm font-medium mb-1">Naam</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-300 text-sm font-medium mb-1">Gebruikersnaam</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-300 text-sm font-medium mb-1">E-mail</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-300 text-sm font-medium mb-1">Wachtwoord</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-300 text-sm font-medium mb-1">Bevestig wachtwoord</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-blue-400 transition">
                        Al een account?
                    </a>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md transition">
                        Registreren
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
