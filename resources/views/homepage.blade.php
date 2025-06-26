@extends('layout')
@section('title', 'Dashboard')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    <hr class="border-t border-gray-300 w-full mb-6">

    <div class="w-full max-w-full">

        <div class="mb-10 w-full">
            <input type="text" placeholder="Rechercher un apprenti..." class="border rounded px-3 py-2 w-full max-w-full">
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-2/3 space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach ($apprentis as $apprenti)
                        <a href="{{ route('userProfile', ['id' => $apprenti->id]) }}">

                            <div class="relative bg-white border rounded-lg p-4 shadow hover:shadow-md transition">

                                <div class="flex justify-center mb-4">
                                    @if ($apprenti->photo)
                                        <img src="{{ $apprenti->photo }}"
                                            class="w-20 h-20 object-cover rounded-full border-4 border-green-200 shadow-sm" />
                                    @else
                                        <div
                                            class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                                            ?</div>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $apprenti->name }}
                                        {{ $apprenti->lastname }}</h3>
                                    <p class="text-sm text-gray-600">
                                        @if ($apprenti->role == 'Apprenti-Commerce')
                                            Employé de commerce
                                        @else
                                            Informaticien développement
                                        @endif
                                    </p>
                                    <p class="text-sm text-gray-500">Chez {{ $apprenti->entreprise }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="w-full lg:w-1/3 bg-gray-50 p-5 rounded-lg border border-gray-200 shadow-sm">
                <h2 class="text-xl font-semibold mb-4">Filtres</h2>

                <div class="mb-6 space-y-2">
                    <p class="text-sm text-gray-600 font-medium mb-1">Trier par :</p>
                    <div class="flex flex-wrap gap-2">
                        <button
                            class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-blue-100 text-sm text-gray-700">Durée
                            du CFC</button>
                        <button
                            class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-blue-100 text-sm text-gray-700">Par
                            année</button>
                        <button
                            class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-blue-100 text-sm text-gray-700">Plus
                            récents</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-1">
                    @php
                        $filtres = [
                            'entreprise' => 'En entreprise',
                            'formation' => 'En centre de formation',
                            'alphabetique' => 'Par ordre alphabétique',
                            'annee' => 'Durée du CFC',
                            'informaticien-dev' => 'Informaticien développement',
                            'employé-com' => 'Employé de commerce',
                        ];
                    @endphp

                    @foreach ($filtres as $value => $label)
                        <div
                            class="border border-gray-300 rounded-lg p-3 text-center hover:bg-blue-50 transition cursor-pointer">
                            <input type="checkbox" id="{{ $value }}" name="formation[]" value="{{ $value }}"
                                class="hidden peer">
                            <label for="{{ $value }}"
                                class="block font-medium text-gray-700 peer-checked:text-blue-600 peer-checked:font-semibold peer-checked:bg-blue-100 peer-checked:border-blue-500 rounded-md px-2 py-1">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
@endsection
