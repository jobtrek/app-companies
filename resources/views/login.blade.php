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

        <img
            src="{{ asset('images/Job.png') }}"
            class="bg-white rounded-full w-24 h-24 object-cover absolute -top-12 left-1/2
                   transform -translate-x-1/2 border-4 shadow-lg border-regal-blue"
        />

        <div class="bg-gray-400 p-6 sm:p-8 pt-20 rounded-3xl flex flex-col gap-6 custom-bg">

            <div class="flex flex-col gap-6 mt-4">
                <h1 class="font-[Roboto_Mono] text-2xl sm:text-3xl text-center text-white">Connexion</h1>
                <select class="text-white border border-white text-center rounded-lg bg-transparent p-2">
                    <option>Se connecter en tant que ...</option>
                    <option class="text-black" value="Apprenti">Apprenti</option>
                    <option class="text-black" value="Formateur Informaticien">Formateur Informaticien</option>
                    <option class="text-black" value="Formateur Employé de commerce">Formateur Employé de commerce</option>
                    <option class="text-black" value="Coach">Coach</option>
                </select>
                <input type="text"
                       placeholder="Email"
                       class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center"/>
                <input type="password"
                       placeholder="Mot de passe"
                       class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center"/>
            </div>

            <button
                class="bg-[#1E1D1C] hover:bg-[#1C2366]
                active:scale-98 active:bg-[#101426] text-white px-4 py-2 rounded-lg w-full sm:w-2/3
                mx-auto transition-all duration-200 ease-in-out"
            >
                Se connecter
            </button>

        </div>
    </div>
</div>

    <title>Login</title>
</head>
<body class="bg-gray-100 gap-4">

<div class="w-1/3 mx-auto mt-40 relative items-center rounded-lg">

    <img
        src="{{ asset('images/Job.png') }}"
        class="bg-white rounded-full w-32 h-32 object-cover absolute -top-16 left-1/2
           transform -translate-x-1/2 border-4 shadow-lg  border-regal-blue mt-8"
    />

    <div class="bg-gray-400 p-10 pt-18 rounded-3xl flex flex-col gap-6 custom-bg">

        <div class="flex flex-col gap-8 mt-8">
            <h1 class="font-[Roboto_Mono] text-3xl text-center text-white">Login</h1>
            <select class="text-white  border-white text-center">
                <option>Se connect en tant que...</option>
                <option class="text-black" value="Apprenti"> Apprenti</option>
                <option class="text-black" value="Formateur">Formateur</option>
                <option class="text-black" value="Coach">Coach</option>
            </select>
            <input type="text"
                   placeholder="Email"
                   class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300 text-center"/>
            <input type="password"
                   placeholder="Password"
                   class="text-white border p-2 rounded-lg bg-transparent placeholder-gray-300   text-center custom-placeholder"/>

        </div>
        <button
            class="bg-[#1E1D1C] hover:bg-[#1C2366]
            active:scale-98 active:bg-[#101426] text-white px-4 py-2 rounded-lg w-2/3
             mx-auto transition-all duration-200 ease-in-out"
        >
            Login
        </button>



    </div>

</div>

</body>
</html>
