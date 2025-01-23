<?php

use App\Models\Championship;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should list all championships and their attributes', function (){
    $this->seed(DatabaseSeeder::class);
    $user = User::factory()->createOne();
    actingAs($user);
    $championships = Championship::all();
    $request = get('/dashboard');

    $championships->each(function ($championship) use ($request){
       $request->assertSee($championship->name);
       $request->assertSee($championship->user->name);
       $request->assertSee($championship->rules);
       $request->assertSee($championship->start);
       $request->assertSee($championship->end);
    });
});
