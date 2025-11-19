@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] border border-gray-800 shadow-md sm:rounded-lg p-6">


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

                @if($errors->any())
                    <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 px-4 py-3 rounded">
                        <ul class="list-disc ml-5 text-red-400">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="text-2xl font-semibold text-gray-100 mb-6">Reactie bewerken</h1>


                <form method="POST" action="{{ route('replies.update', ['threadId' => $threadId, 'topicId' => $topicId, 'replyId' => $reply->reply_id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Reactie *</label>

                        <div id="reply-editor" style="height: 250px;" class="bg-white rounded"></div>
                        <input type="hidden" id="reply-body-input" name="body" value="{{ old('body', $reply->body) }}">

                        @error('body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('topics.show', ['threadId' => $threadId, 'topicId' => $topicId]) }}"
                           class="text-gray-400 hover:text-gray-200 transition">
                            Annuleren
                        </a>

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold">
                            Bijwerken
                        </button>
                    </div>
                </form>

                @if(auth()->user()->isAdmin())
                    <div class="mt-4 text-right">
                        <form method="POST"
                              action="{{ route('replies.destroy', ['threadId' => $threadId, 'topicId' => $topicId, 'replyId' => $reply->reply_id]) }}"
                              onsubmit="return confirm('Weet je zeker dat je deze reactie wilt verwijderen?');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold">
                                Verwijderen
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
