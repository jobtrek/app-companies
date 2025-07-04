@extends('layout')
@section('title', 'Profil utilisateur')
@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg md:mt-40 sm:flex sm:flex-row p-8 gap-8">

        <div class="sm:w-1/3 flex flex-col items-center justify-center min-h-[320px] text-center">

            <div class="flex justify-center mb-4">
                @if ($user->photo)
                    <img src="{{ $user->photo }}"
                        class="w-40 h-40 object-cover rounded-full border-4 border-green-200 shadow-sm" />
                @else
                    <div class="w-40 h-40 text-4xl bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
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

                    <div class="relative inline-block text-left">
                        <button id="toggleButtonEntreprise"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition"
                            type="button" aria-haspopup="true" aria-expanded="false"
                            aria-controls="dropdownWrapperEntreprise">
                            Lier une entreprise
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden"
                            id="dropdownWrapperEntreprise" role="menu" aria-labelledby="toggleButtonEntreprise">
                            <form action="{{ route('users.updateEntreprise', ['user' => $user->id]) }}" method="POST"
                                class="p-4">
                                @csrf
                                @method('PUT')

                                <label for="entreprise_id" class="block text-sm font-semibold text-gray-700">Choisir une
                                    entreprise
                                    :</label>
                                <select name="entreprise_id" id="entreprise_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" disabled selected>-- Sélectionner une entreprise --</option>
                                    @foreach ($entreprises as $e)
                                        <option value="{{ $e->id }}"
                                            {{ $user->entreprise_id == $e->id ? 'selected' : '' }}>
                                            {{ $e->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" id="submitBtnEntreprise"
                                    class="mt-4 w-full py-2 px-4 bg-[#1C2366] text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Confirmer
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                    <li class="font-semibold text-white">Actuelle : {{ $user->entreprise->name ?? 'Aucune' }}

                    </li>
                    @foreach ($previousCompanies ?? [] as $previousCompany)
                        @if($previousCompany->date_de_retour === null)
                        @else
                            <li>{{ $previousCompany->entreprise->name }} ({{ $previousCompany->date_de_départ }} - {{ $previousCompany->date_de_retour }})</li>
                            @endif
                    @endforeach
                </ul>
            </section>

            <section class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <h3 class="font-semibold text-gray-800 mb-4 text-xl">Historique des coachs</h3>

                    <div class="relative inline-block text-left">
                        <button id="toggleButton"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition"
                            type="button" aria-haspopup="true" aria-expanded="false" aria-controls="dropdownWrapper">
                            Lier à un coach
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden"
                            id="dropdownWrapper" role="menu" aria-labelledby="toggleButton">
                            <form action="{{ route('users.updateCoach', ['user' => $user->id]) }}" method="POST"
                                class="p-4">
                                @csrf
                                @method('PUT')

                                <label for="coach_id" class="block text-sm font-semibold text-gray-700">Choisir un coach
                                    :</label>
                                <select name="coach_id" id="coach_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" disabled selected>-- Sélectionner un coach --</option>
                                    @foreach ($coach as $c)
                                        <option value="{{ $c->id }}"
                                            {{ $user->coach_id == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" id="submitBtn"
                                    class="mt-4 w-full py-2 px-4 bg-[#1C2366] text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Confirmer
                                </button>
                            </form>
                        </div>
                    </div>

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
    @can('admin')
        <form method="POST" action="{{ route('users.delete', $user->id) }}" class="w-2/3 sm:w-1/3 mx-auto text-center">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-600 text-white m-10 hover:bg-red-700 active:scale-98 active:bg-blue-800 text-center px-4 py-2 rounded-lg w-1/2 transition-all duration-200 ease-in-out">
                Delete
            </button>
        </form>
    @endcan
@endsection
