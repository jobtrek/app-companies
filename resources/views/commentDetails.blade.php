@extends('layout')

@section('title', 'Détails du commentaire')

@section('content')
    <div class="w-screen lg:w-20/20 ml-0 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800">Commentaire sur l'apprenti : {{$user->name}} {{$user->lastname}}</h1>
        <hr class="border-t border-gray-300 mt-4">
        <section class="bg-white p-6 rounded-lg shadow flex flex-col gap-6">
            <div class="flex-1 space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">{{$comments->title}}</h2>
                <p class="text-gray-700 leading-relaxed break-words">
                    {{$comments->description}}
                </p>

            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 px-4 py-6">
            @foreach($commentFiles as $commentFile)
                <div class="bg-white border border-gray-200 rounded-2xl shadow hover:shadow-xl transition-shadow duration-300 overflow-hidden flex flex-col">
                    <div class="bg-gradient-to-r from-gray-100 to-gray-200 px-5 py-3 flex items-center justify-between">
                        <span class="text-sm font-semibold text-gray-700">Aperçu du fichier</span>
                        <a href="{{ route('comment-file.show', ['filename' => basename($commentFile->path)]) }}"
                           target="_blank"
                           class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                            Ouvrir dans un onglet
                        </a>
                    </div>

                    <iframe
                        src="{{ route('comment-file.show', ['filename' => basename($commentFile->path)]) }}"
                        class="w-19/20 h-96 md:h-[600px] bg-white"
                    ></iframe>
                </div>
            @endforeach
        </section>

        <div class="flex items-center justify-center">
            <form action="{{route('delete.comment', $comments->id)}}" method="POST" class="m-10">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-sm text-white bg-red-600 px-4 py-2 rounded hover:bg-hover-custom cursor-pointer inline-block">
                    Supprimer
                </button>
            </form>
            <form action="{{route('comment.edit', $comments->id)}}" method="GET" class="m-10">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-200">
                    Modifier
                </button>
            </form>
        </div>
    </div>

    <p class="mt-5 text-sm text-gray-500 mb-2">
        Créé le : {{ $comments->created_at->format('d/m/Y H:i') }}
    </p>
    <p class="text-sm text-gray-500 mb-6">
        Dernière édition : {{ $comments->updated_at->format('d/m/Y H:i') }}
    </p>
@endsection
