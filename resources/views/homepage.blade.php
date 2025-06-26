@extends('layout')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-3xl font-bold">Dashboard</h1>
<hr class="border-t border-gray-300 w-full mt-5">
<div>
    <label for="formation" class="mr-2 font-medium">Formation :</label>
    <select id="formation" name="formation" class="border rounded px-2 py-1 cursor-pointer">
        <option value="dev">Informaticien développement d'applications</option>
        <option value="ecom">Employé·e de commerce</option>
    </select>
</div>
<div class="mt-10 mb-6">
    <input type="text" placeholder="Rechercher un apprenti..." class="border rounded px-3 py-2 w-80">
</div>
@foreach ($apprentis as $apprenti)
    <div class="flex flex-col items-start space-y-6 mb-4">
        <div class="flex items-center space-x-4 bg-white p-4 rounded-lg">
<img
    src="{{ $apprenti->photo }}"
    class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-full border-4 border-green-100 shadow-sm"
/>
            <div>
                <h3 class="text-2xl font-semibold text-gray-800">{{ $apprenti->name }} {{ $apprenti->lastname }}</h3>
                <p class="text-sm text-gray-600">Formation :
                    @if ($apprenti->roles->contains("apprenti_commerce"))
                        Employé de commerce
                    @else
                        Informaticien développement d'applications
                    @endif
                </p>
                <p class="text-sm text-gray-600">Actuellement chez {{ $apprenti->entreprise }}</p>
            </div>
        </div>
    </div>
@endforeach
@endsection
