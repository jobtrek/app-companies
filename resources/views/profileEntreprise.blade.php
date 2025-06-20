@extends('layout')
@section('title', 'Profil entreprise')
@section('content')
    <header class="w-2/3">
        <h1 class="text-3xl font-bold">Profil de l'entreprise</h1>
        <hr class="border-t border-gray-300 w-full mt-5">
    </header>
    <main>
        <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between bg-white p-6 rounded-lg shadow-md gap-6">
        <img src="{{ $entreprise->photo }}" 
            class="w-32 h-32 sm:w-75 sm:h-75 object-cover rounded-full border-4 border-green-100" />

        <div class="flex-1 space-y-3">
            <h2 class="text-2xl font-bold text-gray-800">{{ $entreprise->name }}</h2>
            <p class="text-gray-600">
                <span class="font-medium">📧 Email :</span> {{ $entreprise->email }}
            </p>
            <p class="text-gray-600">
                <span class="font-medium">👤 Rôle :</span> {{ $entreprise->role }}
            </p>
            <p class="text-gray-600">
                <span class="font-medium">📞 Téléphone :</span> {{ $entreprise->phone_number }}
            </p>
            <p class="text-gray-600">
                <span class="font-medium">🌐 Site Web :</span>
                <a href="{{ $entreprise->link }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline">
                    {{ $entreprise->link }}
                </a>
            </p>
    </div>

</div>           
<p class="text-gray-600 mt-25">{{ $entreprise->description }}</p>
</main>
@endsection
