@extends('layout')
@section('title', 'Ajouter un commentaire')
@section('script')
    <script>
        function showFileName() {
            const input = document.querySelector('#fileInput');
            const display = document.querySelector('#fileName');
            if (input.files.length > 0) {
                display.textContent = input.files[0].name;
            } else {
                display.textContent = "Aucun fichier choisi";
            }
        }
    </script>
@endsection
@section('content')
    <h1 class="text-2xl font-bold mb-6">Commentaire sur Apprenti (x)</h1>
    <form class="grid grid-cols-2 md:grid-cols-2 gap-5 min-h-[80vh]">
        <div class="flex flex-col gap-4 h-full">
            <input type="text" class="bg-gray-600 h-10 w-full rounded px-3 text-white"
                placeholder="Veuillez écrire le titre de votre commentaire">
            <textarea class="bg-blue-100 w-full flex-grow p-3 rounded resize-none" placeholder="Votre commentaire"></textarea>
        </div>

        <div class="flex flex-col gap-4 md:items-start">
            <img id="preview" class="bg-blue-100 w-full md:w-5/6 h-48 md:h-full p-4 rounded object-contain" />

            <div class="flex flex-row gap-4 items-center w-full max-w-md">
                <input type="file" id="fileInput" style="display: none;" onchange="showFileName()">
                <button type="button"
                    class="bg-[#1E1D1C] hover:bg-[#1C2366] active:scale-95 active:bg-[#101426] text-white px-4 py-2 transition-all duration-200 ease-in-out rounded"
                    onclick="document.querySelector('#fileInput').click();">Choisir un fichier
                </button>
                <p id="fileName" class="bg-blue-100 px-4 py-2 mt-2 text-sm text-blue-700 truncate flex-grow">Aucun fichier
                    choisi</p>
            </div>
        </div>
    </form>
@endsection
