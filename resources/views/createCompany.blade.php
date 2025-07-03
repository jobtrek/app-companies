@extends('layout')
@section('title', 'Ajouter une entreprise')

@section('content')
    <div class="flex items-center justify-center mt-15">
        <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl relative rounded-lg">

            <div class="bg-gray-200 p-6 sm:p-8 pt-20 rounded-3xl flex flex-col gap-6 ">

                <form class="flex flex-col gap-6 mt-4 pt-6" method="post" action="{{ route('company.create') }}" enctype="multipart/form-data">
                    @csrf
                        <img src="{{ asset('images/createaccount_page/edit.svg') }}" alt="Icône éditer"
                            class="bg-transparent w-24 h-24 object-cover absolute -top-12 left-1/2
                                transform -translate-x-1/2"
                            loading="lazy" role="img" />
                        <div class="relative">
                            <input type="text" name="name" placeholder="Nom de l'entreprise"
                                class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full" />
                            <img src="{{ asset('images/createaccount_page/name.svg') }}" alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"
                                role="img" />
                        </div>

                        <div class="relative">
                            <input type="text" name="address" placeholder="Adresse de l'entreprise"
                                class="border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full" />
                            <img src="{{ asset('images/createaccount_page/location.svg') }}"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"
                                role="img" />
                        </div>

                        <div class="relative">
                            <input type="text" name="phone_number" placeholder="Numéro de téléphone"
                                class="border p-2  pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full" />
                            <img src="{{ asset('images/createaccount_page/phone.svg') }}" alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"
                                role="img" />
                        </div>

                        <div class="relative">
                            <input type="email" name="email" placeholder="Mail"
                                class=" border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full" />
                            <img src="{{ asset('images/createaccount_page/email.svg') }}" alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"
                                role="img" />
                        </div>

                        <div class="relative">
                            <textarea type="text" name="description" rows="5" placeholder="Description"
                                   class="border resize-none p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full" ></textarea>
                            <img src="{{ asset('images/createaccount_page/description.svg') }}"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8 " loading="lazy"
                                 role="img" />
                        </div>

                        <div class="relative">
                            <input type="text" name="website" placeholder="Lien du site web"
                                class=" border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full" />
                            <img src="{{ asset('images/createaccount_page/link.svg') }}" alt="Icône email"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"
                                role="img" />
                        </div>

                        <div class="relative">
                            <input type="file" name="photo" placeholder="Image du entreprise"
                                   class=" border p-2 pl-12 rounded-lg bg-gray-300 placeholder-gray-600 text-center w-full " />
                            <img src="{{ asset('images/createaccount_page/file_upload.svg') }}" alt="Icône email"
                                 class="absolute left-3 top-1/2 transform -translate-y-1/2 w-8 h-8" loading="lazy"
                                 role="img" />
                        </div>
                        <button
                            class="bg-[#1E1D1C] hover:bg-[#1C2366]
                            active:scale-98 active:bg-[#101426] text-white px-4 py-2  w-full sm:w-2/3
                             mx-auto transition-all duration-200 ease-in-out rounded-4xl">
                            Ajouter l'entreprise
                        </button>
                </form>
            </div>
        </div>
    </div>
@endsection
