@extends('layout')
@section('title', 'Créer un compte')

@section('content')

    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl relative rounded-lg">

            <div class="bg-gray-200 p-10 sm:p-8 pt-20 rounded-3xl flex flex-col gap-6 ">

                <form>
                    <div class="flex flex-col gap-6 mt-4 pt-6">

                        <img
                            src="{{ asset('images/createaccount_page/edit.svg') }}"
                            alt="Icône éditer"
                            class="w-24 h-24 object-cover absolute -top-12 left-1/2 transform -translate-x-1/2"
                            loading="lazy"
                            role="img"
                        />

                        <div class="relative pl-12">
                            <img
                                src="{{ asset('images/createaccount_page/account.svg') }}"
                                alt="Icône utilisateur"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />

                            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-4 justify-center w-full">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="admin" class="form-checkbox text-blue-600">
                                    <span class="ml-2">Admin</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="formateur" class="form-checkbox text-blue-600">
                                    <span class="ml-2">Formateur</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="apprenti" class="form-checkbox text-blue-600">
                                    <span class="ml-2">Apprenti</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="coach" class="form-checkbox text-blue-600">
                                    <span class="ml-2">Coach</span>
                                </label>
                            </div>
                        </div>

                        <div class="relative">
                            <select class="text-center border p-2 rounded-lg w-full bg-gray-300">
                                <option disabled selected>Domaine de l'utilisateur</option>
                                <option value="Informatique">Informatique</option>
                                <option value="Commerce">Commerce</option>
                            </select>
                            <img
                                src="{{ asset('images/createaccount_page/account.svg') }}"
                                alt="Icône domaine"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />
                        </div>


                        <div class="relative">
                            <input type="email" placeholder="Email"
                                   class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img src="{{ asset('images/createaccount_page/email.svg') }}" alt="Icône email"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"/>
                        </div>

                        <div class="relative">
                            <input type="password" placeholder="Mot de passe"
                                   class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img src="{{ asset('images/createaccount_page/password.svg') }}" alt="Icône mot de passe"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"/>
                        </div>

                        <div class="relative">
                            <input type="password" placeholder="Confirmer le mot de passe" 
                                   class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img src="{{ asset('images/createaccount_page/password.svg') }}" alt="Icône confirmation"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"/>
                        </div>

                        <div class="relative">
                            <input type="text" placeholder="Nom" value="lastname"
                                   class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img src="{{ asset('images/createaccount_page/name.svg') }}" alt="Icône nom"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"/>
                        </div>

                        <div class="relative">
                            <input type="text" placeholder="Prénom" value="name"
                                   class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img src="{{ asset('images/createaccount_page/name.svg') }}" alt="Icône prénom"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"/>
                        </div>

                        <button
                            class="bg-[#1E1D1C] hover:bg-[#1C2366] active:scale-98 active:bg-[#101426]
                               text-white px-4 py-2 w-full sm:w-2/3 mx-auto transition-all duration-200
                               ease-in-out rounded-full">
                            Créer le compte
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

