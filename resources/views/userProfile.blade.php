@extends('layout')
@section('title', 'Profil utilisateur')
@section('content')
    <div class="shadow-lg rounded-xl md:mt-40">
        <div class=" sm:flex sm:flex-row p-8 gap-8">

            <div class="sm:w-1/3 flex flex-col items-center justify-center min-h-[320px] text-center">

                <div class="flex justify-center mb-4">
                    @if ($user->photo)
                        <img src="{{ $user->photo }}"
                            class="w-40 h-40 object-cover rounded-full border-4 border-green-50 shadow-sm" />
                    @else
                        <div class="w-40 h-40 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                            ?
                        </div>
                    @endif
                </div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">{{ $user->name }} {{ $user->lastname }}</h2>
                <p class="mt-2 text-green-700 font-semibold text-lg">
                    @if ($user->roles->contains('apprenti_commerce'))
                        Apprenti Employé de commerce
                    @elseif ($user->roles->contains('apprenti_informaticien'))
                        Apprenti Informaticien
                    @elseif ($user->roles->contains('coach'))
                        Coach
                    @elseif ($user->roles->contains('admin'))
                        Admin
                    @elseif ($user->roles->contains('formateur_commerce'))
                        Formateur Employé de commerce
                    @elseif ($user->roles->contains('formateur_informaticien'))
                        Formateur Informaticien
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

                        @can ('formateurs')
                            <div class="relative inline-block text-left">
                                <button id="toggleButtonEntreprise"
                                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition"
                                    type="button" aria-haspopup="true" aria-expanded="false"
                                    aria-controls="dropdownWrapperEntreprise">
                                    <a href="/user-profile-update/{{ $user->id }}">Lier une entreprise</a>
                                </button>
                            </div>
                        @endcan


                    </div>
                    <ul class="list-disc pl-6 text-gray-700 space-y-1">
                        <li class="font-semibold text-white">Actuelle : {{ $user->entreprise->name ?? 'Aucune' }}

                        </li>
                        @foreach ($previousCompanies ?? [] as $previousCompany)
                            @if ($previousCompany->date_de_retour)
                                <li>{{ $previousCompany->entreprise->name }} ({{ $previousCompany->date_de_départ }}
                                    - {{ $previousCompany->date_de_retour }})
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </section>

                <section class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <h3 class="font-semibold text-gray-800 mb-4 text-xl">Historique des coachs</h3>
                        <a href="/user-profile-update/{{ $user->id }}">

                            @can ('formateurs')
                                <a href="/user-profile-update/{{ $user->id }}">
                                    <div class="relative inline-block text-left">
                                        <button id="toggleButton"
                                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition"
                                            type="button" aria-haspopup="true" aria-expanded="false">
                                            Lier à un coach
                                        </button>
                                    </div>
                                </a>
                            @endcan
                        </a>

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

                @can('coach')
                    @if (Auth::user()->id === $user->coach_id)
                        <section class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                            <div class="flex flex-col md:flex-row items-center justify-between">
                                <h3 class="font-semibold text-gray-800 mb-4 text-xl">Historique des commentaire</h3>
                                <a href="/create-comment/{{ $user->id }}">

                                    <div class="relative inline-block text-left">
                                        <button id="toggleButton"
                                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition"
                                            type="button" aria-haspopup="true" aria-expanded="false">
                                            Ajouter un commentaire

                                        </button>
                                    </div>
                                </a>

                            </div>
                            @if ($comment->isEmpty())
                                <p class="text-white">Aucun commentaire pour cet apprenti.</p>
                            @else
                                <ul class="list-disc pl-6 text-gray-700 space-y-1">
                                    <li class="font-semibold text-white">
                                        <a href="/comments-detail/{{ $lastcommentaire->id }}">Dernier commentaire
                                            : {{ $lastcommentaire ? $lastcommentaire->title : 'Aucun' }}</a>
                                    </li>

                                    @foreach ($comment as $com)
                                        <li>
                                            <p class="flex items-center w-full">
                                                <span class="w-[40%] text-left">
                                                    <a href="/comments-detail/{{ $com->id }}">
                                                        {{ $com->title }}</a>
                                                </span>
                                                <span class="w-[60%] text-left pl-4">

                                                    {{ \Carbon\Carbon::parse($com->created_at)->locale('fr')->translatedFormat('d F Y') }}
                                                </span>
                                                <span class="w-[20%]"></span>
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </section>
                    @endif
                @endcan

            </div>
        </div>
        @can('check_domains_apprenti_formateur', $user)
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8 m-10">

                <a href="/user-profile-update/{{ $user->id }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-200">
                    Modifier
                </a>

            </div>
        @endcan

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8 m-10">
            @if (Auth::check() && Auth::user()->id === $user->id)
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-200">
                        Se déconnecter
                    </button>
                </form>
            @endif
        </div>

    @endsection
