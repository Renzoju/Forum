@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] border border-gray-800 shadow-md sm:rounded-lg p-6">


                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-100 mb-2">
                        {{ $topic->title }}
                    </h1>


                    <div class="prose prose-invert max-w-none text-gray-200">
                        {!! $topic->body !!}
                    </div>

                    <div class="text-sm text-gray-500 mt-3">
                        Gepost door:
                        <strong>{{ $topic->user?->username ?? 'Onbekend' }}</strong>
                        • {{ $topic->created_at->diffForHumans() }}
                    </div>

                    @auth
                        @if(Auth::id() === $topic->user_id || Auth::user()->isAdmin())
                            <div class="mt-4 flex space-x-4">
                                <a href="{{ route('topics.edit', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id]) }}"
                                   class="text-blue-500 hover:underline">Bewerken</a>

                                @if(Auth::user()->isAdmin())
                                    <form method="POST"
                                          action="{{ route('topics.destroy', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id]) }}"
                                          onsubmit="return confirm('Weet je zeker dat je deze topic wilt verwijderen?');"
                                          class="inline">
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

                <hr class="border-gray-800 my-6">


                <div>
                    <h3 class="text-2xl font-semibold text-gray-100 mb-4">
                        Reacties ({{ $topic->replies->count() }})
                    </h3>

                    @forelse($topic->replies as $reply)
                        <div class="border-b border-gray-800 py-4">
                            <div class="prose prose-invert max-w-none text-gray-200">
                                {!! $reply->body !!}
                            </div>

                            <div class="text-sm text-gray-500 mt-2">
                                Door <strong>{{ $reply->user?->username ?? 'Onbekend' }}</strong>
                                • {{ $reply->created_at->diffForHumans() }}
                            </div>

                            @auth
                                @if(Auth::id() === $reply->user_id || Auth::user()->isAdmin())
                                    <div class="mt-2 flex space-x-3">
                                        <a href="{{ route('replies.edit', [
                                            'threadId' => $topic->thread_id,
                                            'topicId' => $topic->topic_id,
                                            'replyId' => $reply->reply_id
                                        ]) }}"
                                           class="text-blue-500 hover:underline">Bewerken</a>

                                        @if(Auth::user()->isAdmin())
                                            <form method="POST"
                                                  action="{{ route('replies.destroy', [
                                                      'threadId' => $topic->thread_id,
                                                      'topicId' => $topic->topic_id,
                                                      'replyId' => $reply->reply_id
                                                  ]) }}"
                                                  onsubmit="return confirm('Weet je zeker dat je deze reactie wilt verwijderen?');"
                                                  class="inline">
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
                    @empty
                        <p class="text-gray-500">Er zijn nog geen reacties op dit topic.</p>
                    @endforelse
                </div>

                <hr class="border-gray-800 my-6">


                @auth
                    <div class="mt-6">
                        <h4 class="text-xl font-semibold text-gray-100 mb-2">
                            Nieuwe reactie plaatsen
                        </h4>

                        <form method="POST"
                              action="{{ route('replies.store', ['threadId' => $topic->thread_id, 'topicId' => $topic->topic_id]) }}">
                            @csrf

                            <div class="mb-4">
                                <div id="reply-editor" style="height: 200px;" class="bg-white rounded"></div>
                                <input type="hidden" id="reply-body-input" name="body" value="{{ old('body') }}">
                            </div>

                            @error('body')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mt-3">
                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold transition">
                                    Reactie plaatsen
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <p class="text-gray-400 mt-4">
                        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log in</a>
                        om een reactie te plaatsen.
                    </p>
                @endauth

            </div>
        </div>
    </div>
@endsection
