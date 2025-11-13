<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Forum - ' . $thread->title) }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow mb-6">
                <h1 class="text-3xl font-bold mb-2">{{ $thread->title }}</h1>
                <p class="text-gray-600 mb-4">{{ $thread->description }}</p>
                <div class="text-sm text-gray-500">
                    Gemaakt door:
                    <strong>{{ $thread->user?->username ?? 'Onbekend' }}</strong>
                    • {{ $thread->created_at->diffForHumans() }}
                </div>
            </div>


            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-2xl font-semibold mb-4">Topics binnen deze thread</h2>

                @if($thread->topics->count() > 0)
                    @foreach($thread->topics as $topic)
                        <div class="border-b border-gray-200 pb-4 mb-4">
                            <h3 class="text-xl font-semibold text-blue-600 hover:underline">
                                <a href="{{ route('topics.show', ['threadId' => $thread->thread_id, 'topicId' => $topic->topic_id]) }}">
                                    {{ $topic->title }}
                                </a>
                            </h3>
                            <p class="text-gray-700 truncate">
                                {{ Str::limit($topic->body, 120, '...') }}
                            </p>
                            <div class="text-sm text-gray-500 mt-1">
                                Door: {{ $topic->user?->username ?? 'Onbekend' }}
                                • {{ $topic->created_at->diffForHumans() }}
                            </div>

                            @auth
                                @if(Auth::id() === $topic->user_id || Auth::user()->isAdmin())
                                    <div class="mt-2 flex space-x-3">
                                        <a href="{{ route('topics.edit', ['threadId' => $thread->thread_id, 'topicId' => $topic->topic_id]) }}"
                                           class="text-blue-500 hover:underline">Bewerken</a>

                                        @if(Auth::user()->isAdmin())
                                            <form method="POST" action="{{ route('topics.destroy', ['threadId' => $thread->thread_id, 'topicId' => $topic->topic_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-500 hover:underline"
                                                        onclick="return confirm('Weet je zeker dat je deze topic wilt verwijderen?')">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500">Er zijn nog geen topics in deze thread.</p>
                @endif

                @auth
                    <div class="mt-6">
                        <a href="{{ route('topics.create', ['threadId' => $thread->thread_id]) }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            + Nieuwe Topic
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
