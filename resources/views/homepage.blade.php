@extends('layout')
@section('title', 'Dashboard')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    <hr class="border-t border-gray-300 w-full mb-6">

    <div class="w-full max-w-full mb-6">
        <div class="flex gap-4 justify-center">
            <button id="btn-apprentis"
                class="px-4 py-2 font-semibold rounded border border-blue-500 text-blue-500 bg-blue-100 hover:border-blue-500 hover:text-blue-500">
                Apprentis
            </button>
            <button id="btn-entreprises"
                class="px-4 py-2 font-semibold rounded border border-gray-300 text-gray-600 hover:border-blue-500 hover:text-blue-500">
                Entreprises
            </button>
        </div>
    </div>

    <div class="w-full max-w-full">
        <div class="w-full mb-5">
            <input type="text" placeholder="Rechercher un apprenti ou une entreprise..." id="global-search"
                class="border rounded px-3 py-2 w-full max-w-full mb-5">
            <div id="search-results" class="absolute bg-white shadow mt-1 rounded max-h-60 overflow-auto w-full" style="display:none;"></div>
        </div>
        <div id="full-container" class="flex flex-col lg:flex-row-reverse gap-8">
            <div id="filters"
                class="w-full lg:w-1/3 h-fit bg-gray-50 p-5 rounded-lg border border-gray-200 shadow lg:sticky top-5">
                <h2 class="text-xl font-semibold mb-4">Filtres</h2>
                <a href="/" class="text-blue-500 hover:text-blue-700 font-semibold">Réinitialiser les filtres</a>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-1 mt-4">
                    @foreach ($filtres as $value => $label)
                        <a href="{{ route('home.sort', ['sort' => $value]) }}">
                            <div
                                class="border border-gray-300 rounded-lg p-3 text-center hover:bg-blue-50 transition cursor-pointer">
                                <input type="button" id="{{ $value }}" name="formation[]"
                                    value="{{ $value }}" class="hidden peer">
                                <label for="{{ $value }}"
                                    class="{{ request()->is('sort/' . $value) ? 'text-green-600 font-semibold bg-blue-100 border-blue-500 rounded-md px-2 py-1' : 'block font-medium text-gray-700 ' }}">
                                    {{ $label }}
                                </label>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div id="section-container" class="flex flex-col w-full lg:w-2/3">
                <div id="section-apprentis">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
                        @foreach ($apprentis as $apprenti)
                            <a href="{{ route('userProfile', ['id' => $apprenti->id]) }}">
                                <div
                                    class="relative bg-white border rounded-lg p-4 shadow hover:shadow-md transition search-card">
                                    <div class="flex justify-center mb-4">
                                        @if ($apprenti->photo)
                                            <img src="{{ $apprenti->photo }}"
                                                class="w-30 h-30 object-cover rounded-full border-3 border-green-50 shadow-sm" />
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
                                            @if ($apprenti->roles->contains('apprenti_commerce'))
                                                Employé de commerce
                                            @elseif ($apprenti->roles->contains('apprenti_informaticien'))
                                                Informaticien développement d'applications
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-500">Chez {{ $apprenti->entreprise->name }}</p> <span
                                            class="mt-3 inline-block text-blue-500 hover:text-blue-700 font-semibold underline cursor-pointer">Voir
                                            le profil</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="w-full overflow-hidden">
                    <div class="max-w-full overflow-x-auto">
                        {{ $apprentis->links() }}
                    </div>
                </div>

            </div>
            <div id="section-entreprises" class="hidden entreprises-section">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="entreprises-list">
                    @foreach ($entreprises as $entreprise)
                        <a href="{{ route('profileEntreprise', ['entreprise' => $entreprise->id]) }}"
                            class="bg-white border rounded-lg p-6 shadow hover:shadow-lg transition flex flex-col items-center text-center entreprises-item">
                            <div class="mb-4">
                                @if ($entreprise->photo)
                                    <!-- ATTENTION : Pour afficher correctement l’image stockée, remplacer $entreprise->photo par asset('storage/' . $entreprise->photo) j'ai utilisé faker pour les entreprises avec lorem picsum donc c'est pour ca que j'ai enlevé -->
                                    <img src="{{ $entreprise->photo }}"
                                        class="w-40 h-40 object-cover rounded-full border-4 border-blue-300 shadow-sm" />
                                @else
                                    <div
                                        class="w-28 h-28 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-4xl font-bold">
                                        🏢</div>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $entreprise->name }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($entreprise->description, 100) }}</p>
                            <span
                                class="mt-3 inline-block text-blue-500 hover:text-blue-700 font-semibold underline cursor-pointer">Voir
                                l'entreprise</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
