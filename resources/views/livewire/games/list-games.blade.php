<div>
    @forelse($this->games as $game)
        <div class="flex justify-center items-center ">
            <div class="bg-white shadow-xl rounded-lg p-6 max-w-lg w-full">

                <h2 class="text-center text-3xl font-semibold text-gray-700 mb-4">Game </h2>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <img src="https://img.icons8.com/external-nawicon-glyph-nawicon/64/external-Football-Club-football-nawicon-glyph-nawicon.png" alt="Escudo Time 1" class="w-12 h-12 mr-3">
                        <span class="text-xl font-semibold text-gray-800">{{$game->team1->name}}</span>
                    </div>

                    <div class="text-2xl font-bold text-gray-800">{{$game->goal_team_1}} - {{$game->goal_team_2}}</div>

                    <div class="flex items-center">
                        <span class="text-xl font-semibold text-gray-800 mr-3">{{$game->team2->name}}</span>
                        <img src="https://img.icons8.com/external-nawicon-outline-color-nawicon/64/external-Football-Club-football-nawicon-outline-color-nawicon.png" alt="Escudo Time 2" class="w-12 h-12">
                    </div>
                </div>

                <div class="text-center text-sm text-gray-600">
                    <p>{{$game->day}}</p>
                    <p>{{$game->local}}</p>
                </div>

                @can('update', $game)
                    <div class="text-end ">
                        <a href="{{route('games.edit',$game)}}" class="inline-flex p-2 text-blue-500 capitalize transition-colors duration-300 transform bg-blue-100 rounded-full rtl:-scale-x-100 dark:bg-blue-500 dark:text-white hover:underline hover:text-blue-600 dark:hover:text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    </div>
                @endcan

            </div>
        </div>
    @empty
        <h1>There is no games</h1>
     @endforelse

</div>
