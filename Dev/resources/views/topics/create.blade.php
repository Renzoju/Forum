@extends('layouts.forum')

@section('content')
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1a1c22] border border-gray-800 shadow-md sm:rounded-lg p-6">


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
                    Nieuwe Topic in: <span class="text-blue-400">{{ $thread->title }}</span>
                </h1>

                <form method="POST" action="{{ route('topics.store', $thread->thread_id) }}">
                    @csrf


                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                            Titel *
                        </label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            maxlength="200"
                            placeholder="Bijv: Hoe gebruik ik Laravel Eloquent?"
                            class="w-full bg-[#111317] border border-gray-700 text-gray-100 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        >
                        @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">
                            Bericht *
                        </label>


                        <div id="topic-editor" style="height: 300px;" class="bg-white rounded"></div>


                        <input type="hidden" id="topic-body-input" name="body" value="{{ old('body') }}">

                        @error('body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex justify-between items-center">
                        <a href="{{ route('threads.show', $thread->thread_id) }}"
                           class="text-gray-400 hover:text-gray-200 transition">
                            Annuleren
                        </a>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">
                            Topic aanmaken
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
