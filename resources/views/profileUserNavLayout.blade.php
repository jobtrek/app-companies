@auth
    <a href="{{ route('userProfile', ['id' => Auth::user()->id]) }}"
        class="flex items-center justify-center md:justify-start space-x-0 md:space-x-4 p-2 md:p-4 rounded-lg cursor-pointer border-2"
        style="border-color: var(--color-green-50)">
        @if (auth()->user()->photo)
            <img src="{{ auth()->user()->photo }}" alt="Photo de {{ auth()->user()->name }}"
                class="w-10 h-10 md:w-14 md:h-14 rounded-full border-2" style="border-color: var(--color-green-50)">
        @else
            <div class="w-10 h-10 md:w-14 md:h-14 bg-gray-200 rounded-full flex justify-center items-center text-gray-500 border-2"
                style="border-color: var(--color-green-50)">
                ?
            </div>
        @endif
        <div class="hidden md:block space-y-1">
            <h3 class="text-lg font-semibold">{{ auth()->user()->name }}</h3>
            <p class="text-sm">{{ auth()->user()->domain->name ?? '' }}</p>
        </div>
    </a>
@endauth

@guest
    <a href="{{ route('login') }}" class="flex items-center space-x-4 p-4 rounded-lg cursor-pointer border-2"
        style="border-color: var(--color-green-50)">
        <div class="w-14 h-14 bg-gray-200 rounded-full flex justify-center items-center text-gray-500 border-2"
            style="border-color: var(--color-green-50)">
            ?
        </div>
        <div>
            <h3 class="text-xl font-semibold">Login</h3>
        </div>
    </a>
@endguest
