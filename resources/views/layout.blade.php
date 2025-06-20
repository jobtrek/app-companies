<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
<body class="flex flex-col md:flex-row min-h-screen">
<aside class="sidebar-bg text-white w-full md:w-64 fixed bottom-0 md:flex flex md:flex-col justify-around md:justify-between p-2 md:py-8 md:px-6 z-10 md:h-screen">
    <div class="hidden md:flex items-center justify-between mb-6">
      <span class="text-2xl font-bold text-green-50">Menu</span>
    </div>

    <nav class="flex w-full justify-around md:flex-col md:space-y-4 md:justify-start text-sm md:text-base">
      <a href="/" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Dashboard</a>
      <a href="/" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Apprenti·e Informaticien</a>
      <a href="/" class="px-3 py-2 sidebar-link text-center md:text-left rounded">Apprenti·e Employé·e de commerce</a>
    </nav>

    <div class="hidden md:flex mt-auto pt-6">
      <div class="flex items-center space-x-4 p-4 rounded-lg">
        <img src="" class="w-14 h-14 rounded-full border-2" style="border-color: var(--color-green-50)">
        <div>
          <h3 class="text-l font-semibold">User</h3>
          <p class="text-sm">Job</p>
        </div>
      </div>
    </div>
  </aside>

<main class="flex-1 md:pl-60 smd:pt-16 md:ml-30 sm:mt-10 max-md:justify-items-center max-sm:flex-sm:flex-col max-sm:justify-items-normal max-sm:ml-5 max-sm:mt-10">
    @yield('content')
  </main>
@yield('script')
</body>
</html>
