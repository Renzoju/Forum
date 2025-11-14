@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-[#1a1c22] border border-gray-800 rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-100 mb-2">
                    {{ $thread->title }}
                </h1>


                <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed">
                    {!! $thread->description !!}
                </div>

                <div class="text-sm text-gray-500 border-t border-gray-700 pt-3 mt-4">
                    Gemaakt door:
                    <span class="text-gray-300 font-semibold">
                    {{ $thread->user?->username ?? 'Onbekend' }}
                </span>
                    • {{ $thread->created_at->diffForHumans() }}
                </div>
            </div>

            {{-- Topics --}}
            <div class="bg-[#1a1c22] border border-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-100 mb-4">
                    Topics binnen deze thread
                </h2>

                @if($thread->topics->count() > 0)
                    @foreach($thread->topics as $topic)
                        <div class="border-b border-gray-800 pb-4 mb-4">
                            <h3 class="text-xl font-semibold text-blue-500 hover:text-blue-400 transition">
                                <a href="{{ route('topics.show', ['threadId' => $thread->thread_id, 'topicId' => $topic->topic_id]) }}">
                                    {{ $topic->title }}
                                </a>
                            </h3>

                            {{-- Topic body (HTML van Quill) --}}
                            <div class="prose prose-invert max-w-none mt-2 text-gray-300 leading-relaxed">
                                {!! Str::limit($topic->body, 250, '...') !!}
                            </div>

                            <div class="text-sm text-gray-500 mt-2">
                                Door:
                                <span class="text-gray-300 font-semibold">
                                {{ $topic->user?->username ?? 'Onbekend' }}
                            </span>
                                • {{ $topic->created_at->diffForHumans() }}
                            </div>

                            @auth
                                @if(Auth::id() === $topic->user_id || Auth::user()->isAdmin())
                                    <div class="mt-3 flex gap-3">
                                        <a href="{{ route('topics.edit', ['threadId' => $thread->thread_id, 'topicId' => $topic->topic_id]) }}"
                                           class="text-blue-500 hover:underline">Bewerken</a>

                                        @if(Auth::user()->isAdmin())
                                            <form method="POST"
                                                  action="{{ route('topics.destroy', ['threadId' => $thread->thread_id, 'topicId' => $topic->topic_id]) }}"
                                                  onsubmit="return confirm('Weet je zeker dat je deze topic wilt verwijderen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">
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
                           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
                            + Nieuwe Topic
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection
