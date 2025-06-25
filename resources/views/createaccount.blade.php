@extends('layout')
@section('title', 'Create a comments')

@section('content')

    <div class="flex items-center justify-center min-h-screen ">
        <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl relative rounded-lg px-4">

            <div class="bg-gray-200 p-6 sm:p-8 pt-20 rounded-3xl flex flex-col gap-6 ">

                <form>
                    <div class="flex flex-col gap-6 mt-4 pt-6">

                        <img
                            src="{{ asset('images/createaccount_page/edit.svg') }}"
                            alt="Icône éditer"
                            class="bg-transparent w-24 h-24 object-cover absolute -top-12 left-1/2
                                transform -translate-x-1/2"
                            loading="lazy"
                            role="img"
                        />

                        <div class="relative">
                            <select class="text-center border p-2 rounded-lg w-full bg-gray-300 ">
                                <option class="bg-transparent text-transparent">Rôle d'utilisateur</option>
                                <option value="Apprenti">Apprenti-e</option>
                                <option value="Formateur">Formateur-ice</option>
                                <option value="Coach">Coach</option>
                            </select>
                            <img
                                src="{{ asset('images/createaccount_page/account.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />
                        </div>

                        <div class="relative">
                            <select class="text-center border p-2 rounded-lg  w-full bg-gray-300">
                                <option class="bg-transparent text-transparent">Domaine</option>
                                <option value="Employé de commerce"> Employé-e de commerce</option>
                                <option value="Informaticien "> Informaticien-ne</option>
                                <option value="Coach">Coach</option>
                            </select>
                            <img
                                src="{{ asset('images/createaccount_page/domaine.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />
                        </div>

                        <div class="relative">
                            <input
                                type="email"
                                placeholder="Email"
                                class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img
                                src="{{ asset('images/createaccount_page/email.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"/>
                        </div>

                        <div class="relative">
                            <input type="password"
                                   placeholder="Mot de passe"
                                   class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img
                                src="{{ asset('images/createaccount_page/password.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />
                        </div>

                        <div class="relative">
                            <input type="password"
                                   placeholder="Comfirmer le mot de passe"
                                   class="border p-2  pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img
                                src="{{ asset('images/createaccount_page/password.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />
                        </div>

                        <div class="relative">
                            <input type="text"
                                   placeholder="Nom"
                                   class=" border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img
                                src="{{ asset('images/createaccount_page/name.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"
                            />
                        </div>

                        <div class="relative">
                            <input type="text"
                                   placeholder="Prémom"
                                   class=" border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full"/>
                            <img
                                src="{{ asset('images/createaccount_page/name.svg') }}"
                                alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8"
                                loading="lazy"
                                role="img"/>
                        </div>

                        <button
                            class="bg-[#1E1D1C] hover:bg-[#1C2366]
                            active:scale-98 active:bg-[#101426] text-white px-4 py-2  w-full sm:w-2/3
                             mx-auto transition-all duration-200 ease-in-out rounded-4xl">
                            Créer le compte
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
