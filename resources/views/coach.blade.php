@extends('layout')
@section('title', 'Page du coach')
@section('content')
    <h1 class="text-3xl font-bold">Bienvenue</h1>
    <hr class="border-t border-gray-300 w-full mt-5">

    <div class="mt-10 mb-6">
        <input type="text" placeholder="Rechercher un apprenti..." class="border rounded px-3 py-2 w-full max-w-full mb-5" id="search">
    </div>
    <div class="space-y-6 min-h-screen">
        @foreach ($apprentis as $apprenti)
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white p-4 rounded-lg shadow-sm gap-4">
                <div class="flex items-center gap-4 flex-1 search-card">
                    <img class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-full border-4 border-green-100 shadow-sm"
                        src="#" alt="Photo de l'apprenti" />
                    <div>
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-800">{{ $apprenti->name }}
                            {{ $apprenti->lastname }}</h3>

                        <p class="text-sm text-gray-600">Formation :
                            @if ($apprenti->roles->contains('apprenti_commerce'))
                                Employé de commerce
                            @else
                                Informaticien développement d'applications
                            @endif
                        </p>
                        @if ($apprenti->commentaires->isNotEmpty())
                            <p class="text-sm text-gray-600">Dernier commentaire le
                                {{ \Carbon\Carbon::parse($apprenti->commentaires->last()->created_at)->locale('fr')->translatedFormat('d F Y') }}
                            </p>
                        @endif

                    </div>
                </div>

                <div class="flex gap-2 justify-start sm:justify-end">
                    <a href=""
                        class="text-sm text-white bg-red-600 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer inline-block">
                        Supprimer
                    </a>

                    <div class="relative inline-block group">
                        <a href=""
                            class="text-sm text-white bg-green-50 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer inline-block">
                            Voir
                        </a>
                        <div class="hidden group-hover:block absolute bg-gray-100 min-w-[160px] shadow-lg z-10 rounded">
                            <div class="w-full max-w-full md:max-w-[600px] mx-auto overflow-x-auto whitespace-nowrap p-2">
                                <div class="w-full max-w-md mx-auto flex flex-col space-y-2 p-2">
                                    @if ($apprenti->commentaires->isEmpty())
                                        <a
                                            class="w-full px-3 py-2 bg-white rounded-md shadow-sm hover:bg-gray-100 transition duration-200 text-sm">
                                            <div class="flex flex-col space-y-1">
                                                <p class="text-xs text-gray-600">
                                                    No comment
                                                </p>
                                            </div>
                                        </a>
                                    @else
                                        @foreach ($apprenti->commentaires as $comment)
                                            <a href="/comments-detail/{{ $comment->id }}"
                                                class="w-full px-3 py-2 bg-white rounded-md shadow-sm hover:bg-gray-100 transition duration-200 text-sm">
                                                <div class="flex flex-col space-y-1">
                                                    <h2 class="text-sm font-semibold text-gray-800 truncate">Titre :
                                                        {{ $comment->title }}</h2>
                                                    <p class="text-xs text-gray-600">
                                                        {{ \Carbon\Carbon::parse($comment->created_at)->locale('fr')->translatedFormat('d F Y') }}
                                                    </p>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href=""
                        class="text-sm text-white bg-green-100 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer inline-block">
                        Modifier
                    </a>
                    <a href="/create-comment/{{ $apprenti->id }}"
                        class="text-sm text-white bg-green-100 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer inline-block">
                        Ajouter
                    </a>

                </div>
            </div>
        @endforeach
    </div>
@endsection
