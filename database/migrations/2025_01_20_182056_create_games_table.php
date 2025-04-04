<?php

use App\Models\Championship;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Championship::class, 'championship_id');
            $table->foreignIdFor(Team::class, 'team_1_id');
            $table->foreignIdFor(Team::class, 'team_2_id');
            $table->integer('goal_team_1')->default(0);
            $table->integer('goal_team_2')->default(0);
            $table->integer('goals')->default(0);
            $table->foreignIdFor(Team::class,'winner')->nullable();
            $table->string('local');
            $table->date('day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
