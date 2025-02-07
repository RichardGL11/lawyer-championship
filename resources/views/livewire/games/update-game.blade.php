<div class="m-5">
    <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Game settings</h2>

        <form wire:submit.prevent="update">
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="team1">First Team</label>
                    <input  wire:model="team1" placeholder="{{$this->team1->name}}" name="team1" disabled>
                    @error('team1') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="team2">Second Team</label>
                    <input  wire:model="team2" name="team2" placeholder="{{$this->team2->name}}" disabled >
                    @error('team2') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="goalTeam1">Goals Firs Team</label>
                    <input type="number" wire:model.live="goalTeam1" min="0" name="goalTeam1">
                    @error('goalTeam1') <span class="text-red-500goalTeam">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="team2">Goals Second Team</label>
                    <input type="number" wire:model.live="goalTeam2" min="0" name="goalTeam2"  >
                    @error('goalTeam2') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-gray-700 dark:text-gray-200" for="team2">Winner</label>
                    <select id="winner" wire:model.live="winner"  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                            <option value="{{null}}">{{null}}</option>
                            <option value="{{$this->team1->id}}">{{$this->team1->name}}</option>
                            <option value="{{$this->team2->id}}">{{$this->team2->name}}</option>
                    </select>
                    @error('winner') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Day</label>
                    <input id="startAt" wire:model.live="day" type="date" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    @error('day') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-gray-700 dark:text-gray-200">Local</label>
                    <input id="endAt" wire:model.live="local" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    @error('local') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button class="px-8 py-2.5 leading-5 text-white transition-colors duration-300 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
            </div>
        </form>
    </section>
</div>

