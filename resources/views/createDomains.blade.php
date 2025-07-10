@extends('layout')
@section('title', 'Création de domaines - Formateur')

@section('content')

    <div class="flex justify-center min-h-screen items-center">
        <div class="w-full max-w-md p-6 bg-white rounded-md shadow-md">
            <h1 class="text-2xl font-semibold mb-6 text-gray-800">Créer un Domaine</h1>
            <form action="{{ route('domains.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-gray-700 mb-1 font-medium">Nom du domaine</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Créer
                </button>
            </form>
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Liste des domaines</h2>

                @if ($domains->isEmpty())
                    <p class="text-gray-500">Aucun domaine enregistré.</p>
                @else
                    <ul class="space-y-2">
                        @foreach ($domains as $domain)
                            <li class="flex justify-between items-center p-3 bg-gray-50 border rounded">
                                <span class="text-gray-800">{{ $domain->name }}</span>

                                <form action="{{ route('domain.delete', $domain->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Supprimer</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <p class="mt-5 text-red-600">*Attention vous ne pouvez pas supprimer un domaine déjà utilisé</p>
            </div>
        </div>
    </div>
    <a href="{{ route('create-account') }}"
        class="flex items-center justify-center md:justify-start px-3 py-2 rounded-md gap-2 bg-green-100 border-2 hover:bg-green-50 absolute">
        <span class="md:inline">&larr;</span>
    </a>
@endsection
