<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">


<nav class="bg-blue-700 text-white p-4 flex justify-between shadow">
    <a href="{{ route('threads.index') }}" class="font-bold">Forum</a>
    <div>
        @auth
            <span class="mr-4">Welkom, {{ Auth::user()->username }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="underline">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="underline mr-2">Login</a>
            <a href="{{ route('register') }}" class="underline">Registreren</a>
        @endauth
    </div>
</nav>


<main class="container mx-auto p-6 flex-grow">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 border border-red-300 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<!-- Footer -->
<footer class="text-center text-gray-500 text-sm py-4 border-t bg-white">
    &copy; {{ date('Y') }} Forum - Devforum.
</footer>

</body>
</html>
