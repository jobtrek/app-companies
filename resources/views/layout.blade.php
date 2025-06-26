<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Dashboard')</title>
  @vite('resources/css/app.css')
</head>
<body class="flex flex-col md:flex-row min-h-screen">

  <aside class="sidebar-bg text-white w-full md:w-64 fixed bottom-0 p-2 md:py-8 md:px-6 z-10 flex md:flex-col justify-around md:justify-between">
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

  <main>
    @yield('content')
  </main>

  @yield('script')
</body>
</html>
