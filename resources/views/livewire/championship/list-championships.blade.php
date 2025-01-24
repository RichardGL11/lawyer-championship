<div class="text-white">
    @dump($this->myTeams())
    <h1>Teams that you are participating: {{$this->myTeams->count()}}</h1>
    @foreach($this->championships as $championship)
        <div><ul>Championship Name: {{$championship->name}}</ul></div>
        <div><ul>Owner for contact: {{$championship->user->name}}</ul></div>
        <div><ul>Rules: {{$championship->rules}}</ul></div>
        <div><ul>Starts at: {{$championship->start}}</ul></div>
        <div><ul>Ends at: {{$championship->end}}</ul></div>
        <div><ul>Teams participating: {{$championship->teams()->count()}}</ul></div>
        <br>

    @endforeach

</div>
