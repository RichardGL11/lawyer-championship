<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    public function championships():BelongsToMany
    {
        return $this->belongsToMany(Championship::class);
    }
    public function captain():BelongsTo
    {
        return $this->belongsTo(User::class,'captain_id');
    }

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
