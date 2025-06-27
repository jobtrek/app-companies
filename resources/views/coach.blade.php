@extends('layout')
@section('title', 'Page du coach')
@section('content')
    <h1 class="text-3xl font-bold">Bienvenue</h1>
    <hr class="border-t border-gray-300 w-full mt-5">
    <div class="mt-10 mb-6">
        <input type="text" placeholder="Rechercher un apprenti..." class="border rounded px-3 py-2 w-full max-w-full mb-5">
    </div>
    <div class="space-y-6">
        @foreach ($apprentis as $apprenti)
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white p-4 rounded-lg shadow-sm gap-4">
                <div class="flex items-center gap-4 flex-1">
                    <img class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-full border-4 border-green-100 shadow-sm"
                        src="#" alt="Photo de l'apprenti" />
                    <div>
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800">{{ $apprenti->name }}
                            {{ $apprenti->lastname }}</h3>

                        <p class="text-sm text-gray-600">Formation :
                            @if ($apprenti->role == 'Apprenti-Commerce')
                                Employé de commerce
                            @else
                                Informaticien développement d'applications
                            @endif
                        </p>
                        <p class="text-sm text-gray-600">Date : commenté le ...</p>
                    </div>
                </div>

                <div class="flex gap-2 justify-start sm:justify-end">
                    <button
                        class="text-sm text-white bg-black px-4 py-2 rounded hover:bg-hover-custom cursor-pointer">Supprimer</button>
                    <button
                        class="text-sm text-white bg-green-100 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer">Modifier</button>
                    <button class="text-sm text-white bg-green-50 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer">
                        Voir
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
