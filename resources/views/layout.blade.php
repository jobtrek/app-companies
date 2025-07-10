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
        class="sidebar-bg text-white w-full md:w-64 fixed bottom-0 md:top-0 md:left-0 md:h-full p-2 md:py-8 md:px-6 z-10 flex flex-col md:justify-between">

        <div class="hidden md:flex items-center mb-6">
            <img src="/images/Jobtrek_logo.png" alt="Logo" class="h-auto rounded-xl"/>
        </div>

        <nav class="flex justify-around md:flex-col md:space-y-4 md:justify-start text-sm md:text-base">
            <a href="/"
                class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                <span class="hidden md:inline">Dashboard</span>
                <img class="hover:animate-spin invert md:hidden w-14 h-14"
                    src="{{ asset('images/layout_nav_page/dashboard.svg') }}" alt="Dashboard">
            </a>

            @auth
                @can('coach')
                    <a href="{{ route('coach') }}"
                        class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                        <span class="hidden md:inline">Coach</span>
                        <img class="hover:animate-spin invert md:hidden w-14 h-14"
                            src="{{ asset('images/layout_nav_page/coach.svg') }}" alt="Coach">
                    </a>
                @endcan

                <div class="flex md:hidden items-center">
                    @include('profileUserNavLayout')
                </div>

                @can('formateurs')
                    <a href="{{ route('create-company') }}"
                        class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                        <span class="hidden md:inline">Création d'entreprises</span>
                        <img class="hover:animate-spin invert md:hidden w-14 h-14"
                            src="{{ asset('images/layout_nav_page/formateur.svg') }}" alt="Formateur">
                    </a>
                @endcan

                @can('admin')
                    <a href="{{ route('create-account') }}"
                        class="flex items-center justify-center md:justify-start px-3 py-2 sidebar-link rounded gap-2">
                        <span class="hidden md:inline">Admin</span>
                        <img class="hover:animate-spin invert md:hidden w-14 h-14"
                            src="{{ asset('images/layout_nav_page/admin.svg') }}" alt="Admin">
                    </a>
                @endcan
            @endauth
        </nav>

        @include('profileUserNavLayout')


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
