<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="inline-flex space-x-*">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Championship: <br>  <span class="underline decoration-blue-500">{{$this->championship->name}}</span></h1>
            <livewire:admin.championship.join-championship :championship="$this->championship"/>
            </div>
            <!-- https://scrimba.com/p/pdqbBcM/cdNv7mtz -->

            <p class="mt-4 text-gray-500 xl:mt-6 dark:text-gray-300">
                <span class="underline decoration-amber-50">
                    Rules:
                </span>
                <br>
                {{$this->championship->rules}}
            </p>

            <div class="container mx-auto p-4 mb-4"  x-data="{ tab: 'tab1' }">
                <h2 class="text-2xl font-bold text-white">Tabs</h2>
                <ul class="flex border-b mt-6">
                    <li class="-mb-px mr-1">
                        <a
                            class="inline-block rounded-t py-2 px-4 font-semibold hover:text-blue-800"  href="#"
                            :class="{ 'bg-white text-blue-700 border-l border-t border-r': tab == 'tab1'}"
                            @click.prevent="tab = 'tab1'"
                        >Games</a>
                    </li>
                    <li class="-mb-px mr-1">
                        <a
                            class="inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                            href="#"
                            :class="{ 'bg-white text-blue-700 border-l border-t border-r': tab == 'tab2'}"
                            @click.prevent="tab = 'tab2'"
                        >Teams</a
                        >
                    </li>
                    <li class="-mb-px mr-1">
                        <a
                            class="inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold"
                            href="#"
                            :class="{ 'bg-white text-blue-700 border-l border-t border-r': tab == 'tab3'}"
                            @click.prevent="tab = 'tab3'"
                        >Tab 3</a
                        >
                    </li>
                </ul>
                <div class="content bg-white px-4 py-4 border-l border-r border-b pt-4">
                    <div x-show="tab == 'tab1'">
                        <livewire:games.create-game/>
                    </div>
                    <div x-show="tab == 'tab2'">
                        <x-card-component :teams="$this->championship->teams"/>
                    </div>
                    <div x-show="tab == 'tab3'">
                        Tab3 content. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt sunt, consectetur eos quod perferendis mollitia consequuntur natus, porro molestiae qui iusto deserunt rerum tempore voluptatum itaque. Ad, nisi esse cum quidem consequuntur ullam obcaecati.
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>
