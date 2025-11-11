@extends('layouts.forum')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-[#0f1115]">
        <div class="bg-[#1a1c22] border border-gray-800 rounded-xl shadow-lg p-8 w-full max-w-md">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="{{ route('home') }}" class="text-3xl font-bold tracking-tight">
                    <span class="text-blue-500">Dev</span><span class="text-white">forum</span><span class="text-blue-500">.</span>
                </a>
            </div>

            <h2 class="text-center text-2xl font-semibold text-gray-100 mb-6">
                Log in bij je account
            </h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-sm text-green-400 bg-green-900/30 border border-green-700 rounded px-4 py-2">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-300 text-sm font-medium mb-1">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-300 text-sm font-medium mb-1">Wachtwoord</label>
                    <input id="password" type="password" name="password" required
                           class="w-full px-4 py-2 bg-[#111217] border border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="h-4 w-4 text-blue-600 border-gray-700 bg-[#111217] focus:ring-blue-500 rounded">
                    <label for="remember_me" class="ml-2 text-sm text-gray-400">Onthoud mij</label>
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:text-blue-400 transition">
                            Wachtwoord vergeten?
                        </a>
                    @endif

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md transition">
                        Inloggen
                    </button>
                </div>

                <div class="text-center mt-6 text-sm text-gray-400">
                    Nog geen account?
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Registreren</a>
                </div>
            </form>
        </div>
    </div>
@endsection
