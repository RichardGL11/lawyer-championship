<div class="text-white">
    @if($teams->isNotEmpty())
        <div x-data="{ isOpen: true }" class="relative inline-block ">
            <!-- Dropdown toggle button -->
            <button @click="isOpen = !isOpen" class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-white border border-transparent rounded-md focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:text-white dark:bg-gray-800 focus:outline-none">
                <span class="mx-1">Your Teams</span>
                <svg class="w-5 h-5 mx-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z" fill="currentColor"></path>
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div x-show="isOpen"
                 @click.away="isOpen = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90"
                 class="absolute right-0 z-20 w-56 py-2 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800"
            >

                <hr class="border-gray-200 dark:border-gray-700 ">

                @foreach($teams as $team)
                    <li class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                        <button wire:click="sendRequest({{ $team }}, {{ $championship }})">
                            Solicitar para o Campeonato: {{ $team->name }}
                        </button>
                    </li>
                    <hr class="border-gray-200 dark:border-gray-700 ">
                @endforeach
            </div>
        </div>
    @else
        <p>Você não tem nenhum time onde seja capitão.</p>
    @endif

</div>
