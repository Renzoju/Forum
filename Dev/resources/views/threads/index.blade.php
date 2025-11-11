@extends('layouts.forum')

@section('content')
    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] shadow-md sm:rounded-lg p-6 border border-gray-800">


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


                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="flex justify-end mb-6">
                            <a href="{{ route('threads.create') }}"
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow-blue-500/30 hover:shadow-blue-400/40 transition">
                                + Nieuwe Thread
                            </a>
                        </div>
                    @endif
                @endauth


                @forelse($threads as $thread)
                    <div class="bg-[#181a1f] hover:bg-[#1e2026] border border-gray-800 rounded-lg p-5 mb-4 transition-all shadow-[0_0_10px_rgba(0,0,0,0.25)]">

                        <h2 class="text-lg font-semibold text-gray-100 hover:text-blue-400 transition">
                            <a href="{{ route('threads.show', $thread->thread_id) }}">
                                {{ $thread->title }}
                            </a>
                        </h2>


                        <p class="text-gray-400 text-sm mt-1">
                            {{ Str::limit($thread->description, 150, '...') }}
                        </p>


                        <div class="flex items-center justify-between mt-3 text-xs text-gray-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-comments text-gray-500"></i>
                                    <span>{{ $thread->topics->count() }} topics</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-pen text-gray-500"></i>
                                    <span>{{ $thread->topics->sum(fn($topic) => $topic->replies->count()) }} posts</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-user text-gray-500"></i>
                                    <span>{{ $thread->user->username ?? 'Onbekend' }}</span>
                                </div>
                            </div>
                            <span>{{ $thread->created_at->format('d M Y') }}</span>
                        </div>


                        @if(auth()->check() && auth()->user()->isAdmin())
                            <div class="mt-3">
                                <a href="{{ route('threads.edit', $thread->thread_id) }}" class="text-blue-500 hover:underline">
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
                                    <button type="submit" class="text-red-500 hover:underline">Verwijderen</button>
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
@endsection
