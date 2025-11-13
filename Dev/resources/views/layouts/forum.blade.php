<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <title>Devforum.</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0f1115] text-gray-300 font-sans antialiased min-h-screen flex flex-col">


<nav class="bg-[#0d0f13] border-b border-gray-800">
    <div class="flex items-center justify-between h-16 pl-4 pr-8 w-full">


        <div class="flex items-center space-x-10">

            <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight">
                <span class="text-blue-500">Dev</span><span class="text-white">forum</span><span class="text-blue-500">.</span>
            </a>

            <!-- NAV LINKS -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}"
                   class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-500' : 'text-gray-300 hover:text-blue-400' }}">
                    Home
                </a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('users.index') }}"
                           class="text-sm font-medium {{ request()->routeIs('users.*') ? 'text-blue-500' : 'text-gray-300 hover:text-blue-400' }}">
                            Users
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="flex items-center space-x-4">
            @auth

                <div class="relative group">
                    <button class="text-sm font-medium text-gray-300 hover:text-blue-400">
                        {{ Auth::user()->username ?? Auth::user()->name }}
                    </button>
                    <div class="absolute right-0 mt-2 w-40 bg-[#1a1c22] border border-gray-800 rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition ease-in-out duration-150 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-800">Profiel</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-800">
                                Uitloggen
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                   class="text-sm font-medium text-gray-300 hover:text-blue-400">
                    Inloggen
                </a>

                <a href="{{ route('register') }}"
                   class="text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded-md">
                    Registreren
                </a>
            @endguest
        </div>
    </div>
</nav>


<main class="flex-1 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        @yield('content')
    </div>
</main>


<footer class="bg-[#0d0f13] border-t border-gray-800 text-gray-500 text-center py-6 mt-auto text-sm">
    <p>© {{ date('Y') }} <span class="text-blue-500 font-semibold">Devforum.</span> Alle rechten voorbehouden.</p>
</footer>


</body>
</html>
