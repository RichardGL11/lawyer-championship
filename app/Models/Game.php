<?php

namespace App\Models;

use App\Observers\GameObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[ObservedBy(GameObserver::class)]
class Game extends Model
{
    /** @use HasFactory<\Database\Factories\GameFactory> */
    use HasFactory;

    protected $guarded = [];

    public function championship():BelongsTo
    {
        return $this->belongsTo(Championship::class,'championship_id');
    }
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    public function assistences(): HasMany
    {
        return $this->hasMany(Assistance::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function team1(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }

    public function team2(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }
}
