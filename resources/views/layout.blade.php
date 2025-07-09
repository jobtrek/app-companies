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
        <div class="hidden md:flex items-center">
            <span class="text-2xl font-bold">Menu</span>
        </div>

        <nav class="flex justify-around md:flex-col md:space-y-4 md:justify-start text-sm md:text-base">
            <a href="/"
                class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                <span class="hidden md:inline">Dashboard</span>
                <img class="md:hidden w-14 h-14" src="{{ asset('images/layout_nav_page/dashboard.svg') }}"
                    alt="Dashboard">
            </a>
            @auth
            @can('coach')
            <a href="{{ route('coach') }}"
                class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                <span class="hidden md:inline">Coach</span>
                <img class="md:hidden w-14 h-14" src="{{ asset('images/layout_nav_page/coach.svg') }}" alt="Coach">
            </a>
            @endcan
            @can('formateurs_or_admin')
            <a href="{{ route('create-company') }}"
                class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                <span class="hidden md:inline">Formateur</span>
                <img class="md:hidden w-14 h-14" src="{{ asset('images/layout_nav_page/formateur.svg') }}"
                    alt="Formateur">
            </a>
            <a href="{{ route('create-account') }}"
                class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                <span class="hidden md:inline">Admin</span>
                <img class="md:hidden w-14 h-14" src="{{ asset('images/layout_nav_page/admin.svg') }}" alt="Admin">
            </a>
            @endcan
            @else
            @endauth
        </nav>



        @auth
            <a href="{{ route('userProfile', ['id' => Auth::user()->id]) }}"
                class="flex items-center justify-center md:justify-start space-x-0 md:space-x-4 p-2 md:p-4 rounded-lg cursor-pointer border-2"
                style="border-color: var(--color-green-50)">
                @if (auth()->user()->photo)
                    <img src="{{ auth()->user()->photo }}" alt="Photo de {{ auth()->user()->name }}"
                        class="w-10 h-10 md:w-14 md:h-14 rounded-full border-2" style="border-color: var(--color-green-50)">
                @else
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-gray-200 rounded-full flex justify-center items-center text-gray-500 border-2"
                        style="border-color: var(--color-green-50)">
                        ?
                    </div>
                @endif
                <div class="hidden md:block space-y-1">
                    <h3 class="text-lg font-semibold">{{ auth()->user()->name }}</h3>
                    <p class="text-sm">{{ auth()->user()->domain->name ?? '' }}</p>
                </div>
            </a>
        @endauth


        @guest
            <a href="{{ route('login') }}" class="flex items-center space-x-4 p-4 rounded-lg cursor-pointer border-2"
                style="border-color: var(--color-green-50)">
                <div class="w-14 h-14 bg-gray-200 rounded-full flex justify-center items-center text-gray-500 border-2"
                    style="border-color: var(--color-green-50)">
                    ?
                </div>
                <div>
                    <h3 class="text-xl font-semibold">Login</h3>
                </div>
            </a>
        @endguest

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
        @if (session('error'))
            <div class="text-red-600 font-semibold my-2 text-center">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

    @yield('script')
</body>

</html>
