@extends('layout')

@section('title', 'Profil entreprise')

@section('content')
    @php
        $editMode = request()->has('edit');
    @endphp

    <div class="shadow-lg rounded-xl md:mt-40">
        <div class="sm:flex sm:flex-row p-8 gap-8">

            <div class="sm:w-1/3 flex flex-col items-center justify-center min-h-[320px] text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ $entreprise->photo }}"
                        class="w-40 h-40 object-cover rounded-full border-4 border-green-200 shadow-sm" />
                </div>
                @if ($editMode)
                    <input type="text" name="name" form="editEntrepriseForm"
                        class="mt-4 w-full text-center border border-gray-300 rounded-lg p-2 text-xl font-bold"
                        value="{{ $entreprise->name }}">
                @else
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">{{ $entreprise->name }}</h2>
                @endif
                <p class="mt-2 text-green-700 font-semibold text-lg">
                    {{ $entreprise->domain ? $entreprise->domain->name : 'Domaine non défini' }}
                </p>
            </div>

            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-6">

                @if ($editMode)
                    <form id="editEntrepriseForm" action="{{ route('company.update', $entreprise) }}" method="POST"
                        class="contents">
                        @csrf
                        @method('PUT')

                        <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5">
                            <span class="text-4xl">📧</span>
                            <div class="w-full">
                                <p class="font-semibold text-gray-700 text-lg">Email</p>
                                <input type="email" name="email" value="{{ $entreprise->email }}"
                                    class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        </div>

                        <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5">
                            <span class="text-4xl">📞</span>
                            <div class="w-full">
                                <p class="font-semibold text-gray-700 text-lg">Téléphone</p>
                                <input type="text" name="phone_number" value="{{ $entreprise->phone_number }}"
                                    class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        </div>

                        <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5 col-span-full">
                            <span class="text-4xl">🏢</span>
                            <div class="w-full">
                                <p class="font-semibold text-gray-700 text-lg">Adresse</p>
                                <input type="text" name="address" value="{{ $entreprise->address }}"
                                    class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        </div>

                        <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5 col-span-full">
                            <span class="text-4xl">🌐</span>
                            <div class="w-full">
                                <p class="font-semibold text-gray-700 text-lg">Site web</p>
                                <input type="text" name="website" value="{{ $entreprise->website }}"
                                    class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        </div>

                        <div class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                            <h3 class="font-semibold text-gray-800 mb-4 text-xl">À propos de cette entreprise</h3>
                            <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg p-3">{{ $entreprise->description }}</textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-8 col-span-full">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow transition">
                                Enregistrer les modifications
                            </button>
                            <a href="{{ route('profileEntreprise', $entreprise) }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-md shadow transition">
                                Annuler
                            </a>
                        </div>
                    </form>
                @else
                    <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5">
                        <span class="text-4xl">📧</span>
                        <div>
                            <p class="font-semibold text-gray-700 text-lg">Email</p>
                            <p class="text-gray-900 break-words">{{ $entreprise->email }}</p>
                        </div>
                    </div>

                    <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5">
                        <span class="text-4xl">📞</span>
                        <div>
                            <p class="font-semibold text-gray-700 text-lg">Téléphone</p>
                            <p class="text-gray-900">{{ $entreprise->phone_number }}</p>
                        </div>
                    </div>

                    <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5 col-span-full">
                        <span class="text-4xl">🏢</span>
                        <div>
                            <p class="font-semibold text-gray-700 text-lg">Adresse</p>
                            <p class="text-gray-900">{{ $entreprise->address }}</p>
                        </div>
                    </div>

                    <div class="bg-green-50 p-5 rounded-xl shadow-md flex items-center gap-5 col-span-full">
                        <span class="text-4xl">🌐</span>
                        <div>
                            <p class="font-semibold text-gray-700 text-lg">Site web</p>
                            <a href="{{ $entreprise->website }}" class="text-blue-600 hover:underline break-words">
                                {{ $entreprise->website }}
                            </a>
                        </div>
                    </div>

                    <div class="bg-green-100 p-6 rounded-xl shadow-md col-span-full">
                        <h3 class="font-semibold text-gray-800 mb-4 text-xl">À propos de cette entreprise</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $entreprise->description }}</p>
                    </div>

                    @auth
                        @if (auth()->user()->hasRole('formateur_informaticien', 'formateur_commerce'))
                            <div class="flex justify-center items-center gap-4 mt-8 col-span-full">
                                <a href="{{ route('profileEntreprise', $entreprise) }}?edit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md shadow transition">
                                    Modifier l'entreprise
                                </a>
                            </div>
                        @endif
                    @endauth
                @endif

                @if ($editMode && auth()->user()->hasRole('formateur_informaticien', 'formateur_commerce'))
                    <form action="{{ route('company.delete', $entreprise) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer cette entreprise ?');"
                        class="col-span-full flex justify-center mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow transition">
                            Supprimer
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
