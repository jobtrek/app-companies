@extends('layout')
@section('title', 'Dashboard')
@section('content')

    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    <hr class="border-t border-gray-300 w-full mb-6">

    <div class="w-full max-w-full">
        <div class="w-full">
            <input type="text" placeholder="Rechercher un apprenti..."
                class="border rounded px-3 py-2 w-full max-w-full mb-5">
        </div>
        <div class="flex flex-col lg:flex-row-reverse gap-8">
            <div class="w-full lg:w-1/3 h-fit bg-gray-50 p-5 rounded-lg border border-gray-200 shadow">
                <h2 class="text-xl font-semibold mb-4">Filtres</h2>
                <a href="/" class="text-blue-500 hover:text-blue-700 font-semibold">Réinitialiser les filtres</a>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-1">

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
            <div class="w-full lg:w-2/3 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach ($apprentis as $apprenti)
                        <a href="{{ route('userProfile', ['id' => $apprenti->id]) }}">

                            <div class="relative bg-white border rounded-lg p-4 shadow hover:shadow-md transition">

                                <div class="flex justify-center mb-4">
                                    @if ($apprenti->photo)
                                        <img src="{{ $apprenti->photo }}"
                                            class="w-20 h-20 object-cover rounded-full border-4 border-green-200 shadow-sm" />
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
                                    <p class="text-sm text-gray-500">Chez {{ $apprenti->entreprise }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
