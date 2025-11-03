<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Topic: ' . $topic->title) }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">


                <div class="mb-6">
                    <h1 class="text-3xl font-bold mb-2">{{ $topic->title }}</h1>
                    <p class="text-gray-700 whitespace-pre-line mb-4">{{ $topic->body }}</p>

                    <div class="text-sm text-gray-500">
                        Gepost door:
                        <strong>{{ $topic->user?->username ?? 'Onbekend' }}</strong>
                        • {{ $topic->created_at->diffForHumans() }}
                    </div>


                    @auth
                        @if(Auth::id() === $topic->user_id || Auth::user()->isAdmin())
                            <div class="mt-3 flex space-x-4">
                                <a href="{{ route('topics.edit', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id]) }}"
                                   class="text-blue-600 hover:underline">Bewerken</a>

                                @if(Auth::user()->isAdmin())
                                    <form method="POST"
                                          action="{{ route('topics.destroy', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id]) }}"
                                          onsubmit="return confirm('Weet je zeker dat je deze topic wilt verwijderen?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Verwijderen
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @endauth
                </div>

                <hr class="my-6">

                {{-- Reacties --}}
                <div>
                    <h3 class="text-2xl font-semibold mb-4">Reacties ({{ $topic->replies->count() }})</h3>

                    @forelse($topic->replies as $reply)
                        <div class="border-b border-gray-200 py-4">
                            <p class="text-gray-800 whitespace-pre-line">{{ $reply->body }}</p>
                            <div class="text-sm text-gray-500 mt-2">
                                Door <strong>{{ $reply->user?->username ?? 'Onbekend' }}</strong>
                                • {{ $reply->created_at->diffForHumans() }}
                            </div>

                            @auth
                                @if(Auth::id() === $reply->user_id || Auth::user()->isAdmin())
                                    <div class="mt-2 flex space-x-3">
                                        <a href="{{ route('replies.edit', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id, 'replyId' => $reply->reply_id]) }}"
                                           class="text-blue-500 hover:underline">Bewerken</a>
                                        @if(Auth::user()->isAdmin())
                                            <form method="POST"
                                                  action="{{ route('replies.destroy', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id, 'replyId' => $reply->reply_id]) }}"
                                                  onsubmit="return confirm('Weet je zeker dat je deze reactie wilt verwijderen?');"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-500 hover:underline">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <p class="text-gray-500">Er zijn nog geen reacties op dit topic.</p>
                    @endforelse
                </div>

                <hr class="my-6">


                @auth
                    <div class="mt-6">
                        <h4 class="text-xl font-semibold mb-2">Nieuwe reactie plaatsen</h4>
                        <form method="POST" action="{{ route('replies.store', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id]) }}">
                            @csrf
                            <textarea
                                name="body"
                                rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                                placeholder="Typ hier je reactie...">{{ old('body') }}</textarea>

                            @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mt-3">
                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                                    Reactie plaatsen
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="text-gray-600 mt-4">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
                        om een reactie te plaatsen.
                    </p>
                @endauth

            </div>
        </div>
    </div>
</x-app-layout>
