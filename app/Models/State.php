<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends EloquentModel
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["name"];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}