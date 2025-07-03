@extends('layout')
<<<<<<< HEAD
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleButton');
            const dropdown = document.getElementById('dropdownWrapper');

            toggleBtn.addEventListener('click', function () {
                dropdown.classList.toggle('hidden');
            });
        });
        const toggleButton = document.getElementById('toggleButton');
        const dropdownWrapper = document.getElementById('dropdownWrapper');
        const submitBtn = document.getElementById('submitBtn');
        const selectCoach = document.getElementById('coach_id');


        selectCoach.addEventListener('change', () => {
            if (selectCoach.value) {
                submitBtn.classList.remove('hidden');
            } else {
                submitBtn.classList.add('hidden');
            }
        });

        
    </script>
@endsection
=======
>>>>>>> refs/remotes/origin/link-coach
@section('title', 'Profil utilisateur')
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('toggleButton');
            const dropdown = document.getElementById('dropdownWrapper');

            toggleBtn.addEventListener('click', function () {
                dropdown.classList.toggle('hidden');
            });
        });
    </script>
@endsection
@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg mt-15 sm:flex sm:flex-row p-8 gap-8">

<<<<<<< HEAD
        <div class="sm:w-1/3 flex flex-col items-center justify-center min-h-[320px] text-center">

            <div class="flex justify-center mb-4">
                @if ($user->photo)
                    <img src="{{ $user->photo }}"
                         class="w-40 h-40 object-cover rounded-full border-4 border-green-200 shadow-sm"/>
                @else
                    <div class="w-40 h-40 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                        ?
                    </div>
                @endif
=======
    <div class="bg-white rounded-lg shadow-md p-5">
        <h1 class="text-3xl font-bold">Profil de l'apprenti(x)</h1>
        <hr class="border-t border-gray-300 w-full mt-5">
        <section class="flex flex-col sm:flex-row items-center  p-6 rounded-lg gap-15">
            <img src="" class="w-32 h-32 sm:w-75 sm:h-75 object-cover rounded-full border-4 border-green-100"/>
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
                    <span class="font-medium">📚 Actuellement chez : </span>{{ $user->entreprise }}
                </p>
                <p class="text-gray-600">
                    <span class="font-medium">Coach actuel :</span> {{ $user->coach ? $user->coach->name : 'Aucun' }}
                </p>
>>>>>>> refs/remotes/origin/link-coach
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

<<<<<<< HEAD
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

                    <div class="relative inline-block text-left">
                        <button
                            id="toggleButton"
                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-md mb-6 font-medium transition"
                            type="button"
                            aria-haspopup="true"
                            aria-expanded="false"
                            aria-controls="dropdownWrapper"
                        >
                            Lier à un coach
                        </button>

                        <div
                            class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-10 hidden"
                            id="dropdownWrapper"
                            role="menu"
                            aria-labelledby="toggleButton"
                        >
                            <form action="{{ route('users.updateCoach', ['user' => $user->id]) }}" method="POST"
                                  class="p-4">
                                @csrf
                                @method('PUT')

                                <label for="coach_id" class="block text-sm font-semibold text-gray-700">Choisir un coach
                                    :</label>
                                <select
                                    name="coach_id"
                                    id="coach_id"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                >
                                    <option value="" disabled selected>-- Sélectionner un coach --</option>
                                    @foreach($coach as $c)
                                        <option value="{{ $c->id }}" {{ $user->coach_id == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <button
                                    type="submit"
                                    id="submitBtn"
                                    class="mt-4 w-full py-2 px-4 bg-[#1C2366] text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
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

=======
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

            <div class="relative w-full">
                <button
                    id="toggleButton"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded shadow-md sm:w-full"
                    type="button"
                >
                    Lier à un coach
                </button>

                <div
                    class="relative w-full mt-4 hidden"
                    id="dropdownWrapper"
                >
                    <form action="{{ route('users.updateCoach', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="coach_id" class="block mb-2 font-semibold">Choisir un coach :</label>

                        <select
                            name="coach_id"
                            id="coach_id"
                            required
                            class="block w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            @foreach($coach as $c)
                                <option value="{{ $c->id }}" {{ $user->coach_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>

                        <button
                            type="submit"
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded"
                        >
                            Comfirmer
                        </button>
                    </form>
                </div>

            </div>

>>>>>>> refs/remotes/origin/link-coach
        </div>

    </div>
@endsection
