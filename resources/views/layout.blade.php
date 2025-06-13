<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <style>
        .sidebar-bg {
            background-color: var(--color-black);
        }
        .sidebar-link {
            transition: background 0.2s;
        }
        .sidebar-link:hover {
            background-color: var(--hover-color);
        }
    </style>
</head>
<body class="mt-20 ml-[450px]">
    <aside class="fixed top-0 left-0 h-full w-100 flex flex-col py-8 px-6 sidebar-bg text-white">
        <div class="mb-10 flex items-center justify-between">
            <span class="text-2xl font-bold text-green-50">Menu</span>
            <span class="inline-flex items-center justify-center w-8 h-8 rounded bg-opacity-10">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" class="cursor-pointer" viewBox="0 0 24 24">
                    <line x1="5" y1="7" x2="19" y2="7" stroke="currentColor" stroke-linecap="round"/>
                    <line x1="5" y1="12" x2="19" y2="12" stroke="currentColor" stroke-linecap="round"/>
                    <line x1="5" y1="17" x2="19" y2="17" stroke="currentColor" stroke-linecap="round"/>
                </svg>
            </span>
        </div>
        <nav class="flex flex-col space-y-4">
            <a href="/" class="rounded px-3 py-2 sidebar-link">Dashboard</a>
            <p>Gestion des apprentis</p>
            <a href="/" class="rounded px-3 py-2 sidebar-link">Apprenti·e Informaticien</a>
            <a href="/" class="rounded px-3 py-2 sidebar-link">Apprenti·e Employé·e de commerce</a>
        </nav>
        <div class="mt-auto">
            <div class="flex items-center space-x-4 p-4 rounded-lg">
                <img src="votre-image-de-profil.jpg" alt="Photo du formateur ou coach" class="w-14 h-14 rounded-full border-2" style="border-color: var(--color-green-50)">
                <div>
                    <h3 class="text-l font-semibold">Nom du formateur || coach</h3>
                    <p class="text-sm">Profession : Formateur || coach</p>
                </div>
            </div>        
        </div>
    </aside>

    <div class="ml-10">
        @yield('content')
    </div>
</body>
</html>
