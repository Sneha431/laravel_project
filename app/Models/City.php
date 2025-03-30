<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\State;
use App\Models\Model;


use App\Models\User;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class City extends EloquentModel
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["name", "state_id"];
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}