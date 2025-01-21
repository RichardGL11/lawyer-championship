<?php

use App\Models\Championship;
use App\Models\Team;
use App\Models\User;
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
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'user_id');
            $table->string('name');
            $table->string('rules');
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });

        Schema::create('championship_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'team_id');
            $table->foreignIdFor(Championship::class, 'championship_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('championships');
    }
};
