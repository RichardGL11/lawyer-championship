<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Championship extends Model
{
    /** @use HasFactory<\Database\Factories\ChampionshipFactory> */
    use HasFactory;

    protected $guarded = [];

    public function teams(): HasMany
    {
        return $this->hasMany('teams');
    }

    public function start(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d')
        );
    }

    public function end(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Carbon::parse($value)->format('Y-m-d')
        );
    }
}
