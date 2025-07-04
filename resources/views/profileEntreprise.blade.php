@extends('layout')

@section('title', 'Profil entreprise')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-900">Profil de l'entreprise</h1>
        <hr class="border-t border-gray-300 mt-5">

        @php
            $editMode = request()->has('edit');
        @endphp

        @if ($editMode)
            <form action="{{ route('company.update', $entreprise) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <section class="flex flex-col sm:flex-row items-center bg-white p-6 gap-6 rounded-lg shadow-md">
                    <div class="w-full sm:w-1/3">
                        <label for="photo" class="block mb-2 text-sm font-medium text-gray-700">Logo entreprise</label>
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500" />
                    </div>

                    <div class="flex-1 space-y-4">
                        <label class="block">
                            <span class="font-medium text-gray-700">Nom de l'entreprise</span>
                            <input type="text" name="name" value="{{ old('name', $entreprise->name) }}" required
                                class="w-full border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500" />
                        </label>

                        <label class="block">
                            <span class="font-medium text-gray-700">Email</span>
                            <input type="email" name="email" value="{{ old('email', $entreprise->email) }}" required
                                class="w-full border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500" />
                        </label>

                        <label class="block">
                            <span class="font-medium text-gray-700">Adresse</span>
                            <input type="text" name="address" value="{{ old('address', $entreprise->address) }}" required
                                class="w-full border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500" />
                        </label>

                        <label class="block">
                            <span class="font-medium text-gray-700">Téléphone</span>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $entreprise->phone_number) }}"
                                class="w-full border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500" />
                        </label>

                        <label class="block">
                            <span class="font-medium text-gray-700">Site Web</span>
                            <input type="url" name="website" value="{{ old('website', $entreprise->website) }}"
                                class="w-full border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500" />
                        </label>

                        <label class="block">
                            <span class="font-medium text-gray-700">Domaine</span>
                            <select name="domain_id"
                                class="w-full border-gray-300 p-2 rounded-md shadow-sm focus:ring-green-500">
                                @foreach ($domains as $domain)
                                    <option value="{{ $domain->id }}"
                                        {{ old('domain_id', $entreprise->domain_id) == $domain->id ? 'selected' : '' }}>
                                        {{ $domain->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </section>

                <section class="bg-white p-6 rounded-lg shadow-md">
                    <label class="block">
                        <span class="font-medium text-gray-700">Description</span>
                        <textarea name="description" rows="5" class="w-full border-gray-300 p-2 rounded-md focus:ring-green-500">{{ old('description', $entreprise->description) }}</textarea>
                    </label>
                </section>

                <div class="flex gap-4 justify-between">
                    <a href="{{ route('profileEntreprise', $entreprise) }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-gray-500">
                        Annuler
                    </a>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        Sauvegarder
                    </button>
                </div>
            </form>
        @else
            <section class="flex flex-col sm:flex-row items-center bg-white p-6 gap-6 rounded-lg shadow-md">
                <img src="{{ asset('storage/' . $entreprise->photo) }}"
                    class="w-32 h-32 sm:w-40 sm:h-40 object-cover rounded-full border-4 border-green-100"
                    alt="Logo entreprise" />

                <div class="flex-1 space-y-3">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $entreprise->name }}</h2>
                    <p class="text-gray-600"><span class="font-medium">📧 Email :</span> {{ $entreprise->email }}</p>
                    <p class="text-gray-600"><span class="font-medium">🏢 Adresse :</span> {{ $entreprise->address }}</p>
                    <p class="text-gray-600"><span class="font-medium">👤 Domaine :</span>
                        {{ $entreprise->domain ? $entreprise->domain->name : 'Non défini' }}</p>
                    <p class="text-gray-600"><span class="font-medium">📞 Téléphone :</span>
                        {{ $entreprise->phone_number }}</p>
                    <p class="text-gray-600">
                        <span class="font-medium">🌐 Site Web :</span>
                        <a href="{{ $entreprise->website }}" target="_blank" rel="noopener"
                            class="text-blue-600 hover:underline">
                            Lien vers le site
                        </a>
                    </p>
                </div>
            </section>

            <section class="bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-xl font-semibold text-gray-800 mb-4">À propos de cette entreprise</h1>
                <p class="text-gray-700 text-base leading-relaxed">{{ $entreprise->description }}</p>
            </section>

            @auth
                @if (auth()->user()->hasRole('admin'))
                    <div class="relative h-30 sm:h-35">
                        <button
                            class="absolute bottom-10 left-1/2 transform -translate-x-1/2 sm:left-0 sm:w-full sm:translate-x-0 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md shadow-md">
                            Lier un apprenti
                        </button>
                    </div>
                    <div class="relative h-20 sm:h-20">
                        <a href="{{ route('profileEntreprise', $entreprise) }}?edit=1"
                            class="absolute bottom-10 left-1/2 transform -translate-x-1/2 sm:left-0 sm:w-full sm:translate-x-0 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md shadow-md text-center">
                            Modifier l'entreprise
                        </a>
                    </div>
                    <div class="relative h-20 sm:h-20">
                        <form action="{{ route('company.delete', $entreprise) }}" method="POST"
                            onsubmit="return confirm('Êtes-vous sûr(e) de vouloir supprimer cette entreprise ?');"
                            class="relative h-20 sm:h-20">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="absolute bottom-10 left-1/2 transform -translate-x-1/2 sm:left-0 sm:w-full sm:translate-x-0 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md shadow-md">
                                Supprimer l'entreprise
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        @endif
    </div>
@endsection
