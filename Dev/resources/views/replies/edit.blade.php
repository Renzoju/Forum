<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reactie bewerken') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded">
                        <ul class="list-disc ml-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form method="POST" action="{{ route('replies.update', ['threadId' => $threadId, 'topicId' => $topicId, 'replyId' => $reply->reply_id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-2">
                            Reactie *
                        </label>
                        <textarea
                            id="body"
                            name="body"
                            rows="6"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >{{ old('body', $reply->body) }}</textarea>
                        @error('body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('topics.show', ['threadId' => $threadId, 'topicId' => $topicId]) }}"
                           class="text-gray-600 hover:text-gray-800">
                            Annuleren
                        </a>

                        <button
                            type="submit"
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
</x-app-layout>
