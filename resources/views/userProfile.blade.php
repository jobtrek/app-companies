@extends('layout')

@section('title', 'Profil utilisateur')

@section('content')

    <div class="bg-white rounded-lg shadow-md p-5">
        <h1 class="text-3xl font-bold">Profil de l'apprenti(x)</h1>
        <hr class="border-t border-gray-300 w-full mt-5">
        <section class="flex flex-col sm:flex-row items-center  p-6 rounded-lg gap-15">
            <img src="" class="w-32 h-32 sm:w-75 sm:h-75 object-cover rounded-full border-4 border-green-100" />
            <div class="flex-1 space-y-3">
                <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }} {{ $user->lastname }}</h2>

                <p class="text-gray-600">
                    <span class="font-medium">📧 Email : </span>{{ $user->email }}
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">👤 Rôle : @if ($user->roles->contains('apprenti_commerce'))
                            Employé de commerce
                        @elseif ($user->roles->contains('apprenti_informaticien'))
                            Informaticien développement d'applications
                        @endif
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">📞 Téléphone : </span>{{ $user->phone_number }}
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">📚 Actuellement chez : </span>{{ $user->entreprise->name }}
                </p>
                <p class="text-gray-600">
                    <span class="font-medium">Coach actuel :</span> {{ $user->coach ? $user->coach->name : 'Aucun' }}
                </p>
            </div>
        </section>

        <section class="bg-white p-6 rounded-lg px-4 sm:px-6 lg:px-8">
            <h1 class="text-xl font-semibold mb-4">Liste des entreprises</h1>
            <ul class="text-gray-700 text-base leading-relaxed">
                <li>{{ $user->entreprise->name }}</li>
            </ul>
        </section>

        <div class="flex flex-col gap-4">
            <div class="relative">
                <button
                    class="
                    w-full bg-blue-600 hover:bg-blue-700
                    text-white font-medium py-2 px-4
                    rounded shadow-md sm:w-full">
                    Lier une entreprise
                </button>
            </div>

            <div class="relative">
                <button
                    class="
                    w-full bg-blue-600 hover:bg-blue-700
                    text-white font-medium py-2 px-4
                    rounded shadow-md sm:w-full">
                    Lier à un coach
                </button>
            </div>
        </div>

    </div>
@endsection
