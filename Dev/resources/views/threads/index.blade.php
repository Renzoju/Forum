<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum - Alle Threads') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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


                @forelse($threads as $thread)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 mb-4">

                        <h2 class="text-xl font-semibold text-blue-700 hover:underline">
                            <a href="{{ route('threads.show', $thread->thread_id) }}">
                                {{ $thread->title }}
                            </a>
                        </h2>


                        <p class="text-gray-700 mt-1">
                            {{ Str::limit($thread->description, 120) }}
                        </p>


                        <div class="flex items-center justify-between text-sm text-gray-500 mt-3">
                            <div class="flex items-center gap-4">
                                <span>👤 {{ $thread->user->username }}</span>
                                <span>💬 {{ $thread->topics->count() }} topics</span>
                            </div>
                            <span>{{ $thread->created_at->diffForHumans() }}</span>
                        </div>


                        @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="mt-3">
                                <a href="{{ route('threads.edit', $thread->thread_id) }}" class="text-blue-600 hover:underline">
                                    Bewerken
                                </a>
                                <form
                                    action="{{ route('threads.destroy', $thread->thread_id) }}"
                                    method="POST"
                                    class="inline ml-2"
                                    onsubmit="return confirm('Weet je zeker dat je deze thread wilt verwijderen?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Verwijderen</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Er zijn nog geen threads aangemaakt.</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
