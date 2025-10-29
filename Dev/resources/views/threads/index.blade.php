<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Forum - Alle Threads') }}
            </h2>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('threads.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        + Nieuwe Thread
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if($threads->count() > 0)
                <div class="space-y-4">
                    @foreach($threads as $thread)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                            <div class="p-6">
                                {{-- Thread Titel --}}
                                <a href="{{ route('threads.show', $thread->thread_id) }}" class="block">
                                    <h3 class="text-2xl font-bold text-gray-900 hover:text-blue-600 mb-2">
                                        {{ $thread->titel }}
                                    </h3>
                                </a>


                                <p class="text-gray-600 mb-4 truncate">
                                    {{ $thread->beschrijving }}
                                </p>


                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                            </svg>
                                            {{ $thread->user->gebruikersnaam }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3 3a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm0 3a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"/>
                                            </svg>
                                            {{ $thread->topics->count() }} topics
                                        </span>
                                    </div>
                                    <span>{{ $thread->created_at->diffForHumans() }}</span>
                                </div>


                                @auth
                                    @if(auth()->user()->isAdmin() || auth()->id() === $thread->user_id)
                                        <div class="mt-4 flex space-x-2">
                                            @if(auth()->id() === $thread->user_id || auth()->user()->isAdmin())
                                                <a href="{{ route('threads.edit', $thread->thread_id) }}"
                                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                                    Bewerken
                                                </a>
                                            @endif

                                            @if(auth()->user()->isAdmin())
                                                <form action="{{ route('threads.destroy', $thread->thread_id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Weet je zeker dat je deze thread wilt verwijderen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                        Verwijderen
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        <p class="mb-4">Er zijn nog geen threads. Wees de eerste!</p>
                        @auth
                            <a href="{{ route('threads.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block">
                                Maak de eerste thread aan
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg inline-block">
                                Log in om een thread te maken
                            </a>
                        @endauth
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
