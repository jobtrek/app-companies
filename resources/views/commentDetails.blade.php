@extends('layout')

@section('title', 'Détails du commentaire')

@section('content')
    <header class="max-w-4xl mx-auto mt-10">
        <h1 class="text-3xl font-bold text-gray-800">Nom de l'apprenti <span class="text-gray-500">(commentaire coach)</span></h1>
        <hr class="border-t border-gray-300 mt-4">
    </header>

    <main class="max-w-4xl mx-auto mt-10 space-y-10">
        <section class="bg-white p-6 rounded-lg shadow flex flex-col gap-6">
            <div class="flex-1 space-y-4">
                <h2 class="text-2xl font-semibold text-gray-900">Titre du commentaire</h2>
        <p class="text-gray-700 leading-relaxed break-words">
        Le commentaire en question, blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla
        </p>

            </div>
        </section>

        <section class="flex flex-row items-center md:items-start gap-6">
            <img
                id="preview"
                class="bg-blue-100 w-full md:w-5/6 h-48 md:h-64 p-4 rounded object-contain"
                alt="Aperçu du fichier sélectionné"
            />
            <img
                id="preview"
                class="bg-blue-100 w-full md:w-5/6 h-48 md:h-64 p-4 rounded object-contain"
                alt="Aperçu du fichier sélectionné"
            />
        </section>

    </main>
@endsection
