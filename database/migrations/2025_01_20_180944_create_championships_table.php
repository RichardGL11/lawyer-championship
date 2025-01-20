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
        Schema::create('championships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('rules');
            $table->date('start');
            $table->date('end');
            $table->timestamps();
        });

        Schema::create('championship_teams', function (Blueprint $table){
            $table->id();
            $table->foreignIdFor(Team::class,'team_id');
            $table->foreignIdFor(Championship::class,'championship_id');
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
