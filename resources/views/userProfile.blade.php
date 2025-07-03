@extends('layout')

@section('title', 'Profil utilisateur')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden sm:flex sm:flex-row p-8 gap-8">

        <div class="sm:w-1/3 flex flex-col items-center justify-center min-h-[320px] text-center">

            <div class="flex justify-center mb-4">
                @if ($user->photo)
                    <img src="{{ $user->photo }}"
                        class="w-40 h-40 object-cover rounded-full border-4 border-green-200 shadow-sm" />
                @else
                    <div class="w-40 h-40 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                        ?
                    </div>
                @endif
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">{{ $user->name }} {{ $user->lastname }}</h2>
            <p class="mt-2 text-green-700 font-semibold text-lg">
                @if ($user->roles->contains('apprenti_commerce'))
                    Employé de commerce
                @elseif ($user->roles->contains('apprenti_informaticien'))
                    Informaticien développement d'applications
                @else
                    Rôle non défini
                @endif
            </p>
        </div>

        <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5">
                <span class="text-4xl">📧</span>
                <div>
                    <p class="font-semibold text-gray-700 text-lg">Email</p>
                    <p class="text-gray-900 text-base break-words">{{ $user->email }}</p>
                </div>
            </div>

            <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5">
                <span class="text-4xl">📞</span>
                <div>
                    <p class="font-semibold text-gray-700 text-lg">Téléphone</p>
                    <p class="text-gray-900 text-base">{{ $user->phone_number ?: 'Non renseigné' }}</p>
                </div>
            </div>

            <section class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                <div class="flex flex-col md:flex-row items-center justify-between">

                    <h3 class="font-semibold text-gray-800 mb-4 text-xl">Historique des entreprises</h3>
                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition">
                        Lier une entreprise
                    </button>
                </div>
                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                    <li class="font-semibold text-white">Actuelle : {{ $user->entreprise ?? 'Aucune' }}

                    </li>
                    @foreach ($user->previous_companies ?? [] as $previousCompany)
                        <li>{{ $previousCompany->name }} (anciennement)</li>
                    @endforeach
                </ul>
            </section>

            <section class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <h3 class="font-semibold text-gray-800 mb-4 text-xl">Historique des coachs</h3>
                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition">
                        Lier à un coach
                    </button>
                </div>
                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                    <li class="font-semibold text-white">
                        Actuel : {{ $user->coach ? $user->coach->name : 'Aucun' }}
                    </li>
                    @foreach ($user->previous_coachs ?? [] as $previousCoach)
                        <li>{{ $previousCoach->name }} (ancien coach)</li>
                    @endforeach
                </ul>
            </section>

        </div>
    </div>
@endsection
