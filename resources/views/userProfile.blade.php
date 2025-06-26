@extends('layout')

@section('title', 'Profil utilisateur')

@section('content')

<div class="ml-0 p-6 bg-white rounded-lg shadow-md lg:ml-60">
        <h1 class="text-3xl font-bold">Profil de l'utilisateur</h1>
        <hr class="border-t border-gray-300 w-full mt-5">
        <section class="flex flex-col sm:flex-row items-center bg-white p-6 rounded-lg shadow-md gap-6">
            <img 
                src="" 
                class="w-32 h-32 sm:w-75 sm:h-75 object-cover rounded-full border-4 border-green-100"
            />

            <div class="flex-1 space-y-3">
                <h2 class="text-2xl font-bold text-gray-800">Nom de l'utilisateur</h2>
                
                <p class="text-gray-600">
                    <span class="font-medium">📧 Email :</span>Email de l'utilisateur
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">👤 Rôle :</span>Métier de l'utilisateur
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">📞 Téléphone :</span>Numéro de téléphone de l'utilisateur
                </p>

            </div>
        </section>

        <section class="bg-white p-6 rounded-lg shadow-md px-4 sm:px-6 lg:px-8">
            <h1 class="text-xl font-semibold mb-4">Liste des entreprises</h1>
            <p class="text-gray-700 text-base leading-relaxed">
                text
            </p>
        </section>

        <div class="flex flex-col gap-4">
            <div class="relative">
                <button class="
                    w-full bg-blue-600 hover:bg-blue-700 
                    text-white font-medium py-2 px-4 
                    rounded shadow-md sm:w-full">
                    Lier une entreprise
                </button>
            </div>

            <div class="relative">
                <button class="
                    w-full bg-blue-600 hover:bg-blue-700 
                    text-white font-medium py-2 px-4 
                    rounded shadow-md sm:w-full">
                    Lier à un coach
                </button>
            </div>
        </div>

    </div>
@endsection
