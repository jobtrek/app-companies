<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col md:flex-row min-h-screen">

    <aside
        class="sidebar-bg text-white w-full md:w-64 fixed bottom-0 p-2 md:py-8 md:px-6 z-10 flex md:flex-col justify-around md:justify-between">
        <div class="hidden md:flex items-center justify-between mb-6">
            <span class="text-2xl font-bold text-green-50">Menu</span>
        </div>

        <nav class="flex w-full justify-around md:flex-col md:space-y-4 md:justify-start text-sm md:text-base">
            <a href="/" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Dashboard</a>
            <a href="{{ route('coach') }}" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Coach - commentaires</a>
            <a href="{{ route('create-company') }}" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Formateur - Ajouts d'entreprises</a>
            <a href="{{ route('create-account') }}" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Admin - création des comptes</a>
        </nav>

        <div class="hidden md:flex mt-auto pt-6">
            <a href="{{ route('login') }}">
                <div class="flex items-center space-x-4 p-4 rounded-lg">
                    <img src="" class="w-14 h-14 rounded-full border-2"
                        style="border-color: var(--color-green-50)">
                    <div>
                        <h3 class="text-l font-semibold">Login</h3>
                        <p class="text-sm">Role/Job</p>
                    </div>
                </div>
            </a>

        </div>
    </aside>

    <main>
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-white rounded text-center">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')

    </main>

    @yield('script')
</body>

</html>
