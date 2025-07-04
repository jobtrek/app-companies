@extends('layout')

@section('title', 'Profil entreprise')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold">Profil de l'entreprise</h1>
        <hr class="border-t border-gray-300 w-full mt-5">
        <section class="flex flex-col sm:flex-row items-center bg-white p-6 gap-6">
            <img class="w-32 h-32 sm:w-75 sm:h-75 object-cover rounded-full border-4 border-green-100" />

            <div class="flex-1 space-y-3">
                <h2 class="text-2xl font-bold text-gray-800">{{ $entreprise->name }}</h2>

                <p class="text-gray-600">
                    <span class="font-medium">📧 Email :</span> {{ $entreprise->email }}
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">👤 Domaine :</span>{{ $entreprise->domain->Domain }}
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">📞 Téléphone : {{ $entreprise->phone_number }}</span>
                </p>

                <p class="text-gray-600">
                    <span class="font-medium">🌐 Site Web :</span>
                    <a href="{{ $entreprise->website }}" target="_blank" rel="noopener"
                        class="text-blue-600 hover:underline">
                        Lien de l'entreprise
                    </a>
                </p>
            </div>
        </section>

        <section class="bg-white p-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-xl font-semibold mb-4">À propos de cette entreprise</h1>
            <p class="text-gray-700 text-base leading-relaxed">
                {{ $entreprise->description }}
            </p>
        </section>

        <div class="relative h-30 sm:h-35">
            <button
                class="
                absolute bottom-10 left-1/2 w-max transform -translate-x-1/2
                sm:left-0 sm:w-full sm:translate-x-0
                bg-blue-600 hover:bg-blue-700
                text-white font-medium py-2 px-4
                rounded shadow-md">
                Lier un apprenti
            </button>
        </div>
        @auth
            @if (auth()->user()->hasRole('admin'))
                <div class="relative h-20 sm:h-20">
                    <form action="{{ route('company.delete', $entreprise) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?');"
                        class="relative h-20 sm:h-20">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="
                        absolute bottom-10 left-1/2 w-max transform -translate-x-1/2
                        sm:left-0 sm:w-full sm:translate-x-0
                        bg-red-600 hover:bg-red-700
                        text-white font-medium py-2 px-4
                        rounded shadow-md">
                            Supprimer l'entreprise
                        </button>
                    </form>
                </div>
            @endif
        @endauth

    </div>
@endsection
