<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
<div class="flex items-center justify-center min-h-screen bg-gray-800">
    <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl relative rounded-lg px-4">
        <form method="post" action="{{ route('login') }}">
            @csrf
            <img
                src="{{ asset('images/Jobtrek_logo.png') }}"
                class="bg-white rounded-full w-24 h-24 object-cover absolute -top-12 left-1/2
                   transform -translate-x-1/2 border-4 shadow-lg border-regal-blue"
            />

            <div class="bg-gray-400 p-6 sm:p-8 pt-20 rounded-3xl flex flex-col gap-6 custom-bg">

                <div class="flex flex-col gap-6 mt-4">
                    <h1 class="font-[Roboto_Mono] text-2xl sm:text-3xl text-center text-white">Connexion</h1>
                    <input type="text"
                           placeholder="Email"
                           name="email"
                           class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center"/>
                    <input type="password"
                           placeholder="Mot de passe"
                           name="password"
                           class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center"/>
                </div>

                <button
                    class="bg-[#1E1D1C] hover:bg-[#1C2366]
                active:scale-98 active:bg-[#101426] text-white px-4 py-2 rounded-lg w-full sm:w-2/3
                mx-auto transition-all duration-200 ease-in-out cursor-pointer"
                >
                    Se connecter
                </button>

            </div>
        </form>
    </div>
</div>

</body>
</html>
