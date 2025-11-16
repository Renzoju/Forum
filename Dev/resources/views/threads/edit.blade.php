@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                @if ($errors->any())
                    <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 px-4 py-3 rounded">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <h1 class="text-2xl font-semibold text-gray-100 mb-6">
                    Thread bewerken
                </h1>


                <form method="POST" action="{{ route('threads.update', $thread->thread_id) }}">
                    @csrf
                    @method('PUT')


                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                            Titel *
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title', $thread->title) }}"
                            class="w-full bg-[#111317] border border-gray-700 text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            maxlength="200"
                            required
                            placeholder="Bijv: Laravel hulp of PHP discussie"
                        >
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Beschrijving *
                        </label>


                        <div id="thread-editor" style="height: 300px;" class="bg-white rounded"></div>


                        <input type="hidden" id="thread-description-input" name="description"
                               value="{{ old('description', $thread->description) }}">

                        @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-between">
                        <a href="{{ route('threads.show', $thread->thread_id) }}" class="text-gray-400 hover:text-gray-200 transition">
                            Annuleren
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            Thread bijwerken
                        </button>
                    </div>
                </form>


                @if(auth()->user()->isAdmin())
                    <form
                        action="{{ route('threads.destroy', $thread->thread_id) }}"
                        method="POST"
                        class="mt-6"
                        onsubmit="return confirm('Weet je zeker dat je deze thread wilt verwijderen?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                        >
                            Verwijderen
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
